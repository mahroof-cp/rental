<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\MetalType\MetalTypeRepositoryInterface as MetalTypeRepository;
use App\Repositories\Settings\SettingsRepositoryInterface as SettingsRepository;
use App\Repositories\Cart\CartRepositoryInterface as CartRepository;

class Settings
{
    protected $settingsRepo;
    protected $metalTypeRepo;
    protected $cartRepo;

    public function __construct(SettingsRepository $settingsRepo, MetalTypeRepository $metalTypeRepo, CartRepository $cartRepo)
    {
        $this->settingsRepo = $settingsRepo;
        $this->metalTypeRepo = $metalTypeRepo;
        $this->cartRepo = $cartRepo;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (
            !request()->isMethod('post') && auth()->check()
            && auth()->user()->is_guest
            && request()->route()->getName() != 'web_checkout_review'
            && request()->route()->getName() != 'web_checkout_payment_success'
            && request()->route()->getName() != 'web_checkout_payment_failure'
            && request()->route()->getName() != 'web_checkout_thankyou'
        ) {
            $this->cartRepo->UnSyncAuthCart();
            auth()->logout();
            redirect(request()->url());
        }
        /**
         * Load general settings to cache and remains for 5 min
         */
        $settings = cache()->remember('settings', 1800, function () {
            try {
                $settingsArray = $this->settingsRepo->autoLoad()->pluck('value', 'key')->toArray();
            } catch (\Exception $e) {
                $settingsArray = [];
            }
            return $settingsArray;
        });
        config()->set('settings', $settings);

        $savingsMetal = cache()->remember('savings_metal', 1800, function () {
            try {
                $savingsMetalArray = $this->metalTypeRepo->getSavingsMetal()->toArray();
            } catch (\Exception $e) {
                $savingsMetalArray = [];
            }
            return $savingsMetalArray;
        });
        config()->set('savings_metal', $savingsMetal);

        return $next($request);
    }
}