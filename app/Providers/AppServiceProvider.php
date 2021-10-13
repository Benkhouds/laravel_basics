<?php

namespace App\Providers;

use App\Services\Helper;
use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() : void
    {
        //
        $this->app->bind('foo', function(){
            return 'bar' ;
        });

        //laravel would execute this process on every call to the container
       /* $this->app->bind(Newsletter::class, function($app){
            //$app->make(ApiClient::class) would resolve the APiClient key
            //==> it would make an instance of the ApiKey and its dependencies
            $client = $app->make(ApiClient::class)->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us5'
            ]);
           return new MailchimpNewsletter($client);
        });*/
        //the singleton method binds  a class or interface into the container that
        //should be resolved only once (first class)

        $this->app->singleton(Newsletter::class, function(){
            $client = (new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us5'
            ]);
            return new MailchimpNewsletter($client);
        });

        //if you already have an instance that you want to use on every call to the container
        /*$client = (new ApiClient)->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us5'
        ]);
        $this->app->instance(Newsletter::class,(new MailchimpNewsletter($client)));*/

        //we can also bind an implementation to an interface
        //so if we had a Newsletter interface and a MailchimpNewsletter implementation
        //we can bind it like this :
       // $this->app(Newsletter::class, MailchimpNewsletter::class);

        //Contextual binding
        //if you have multiple classes that implements the same interface
        //but have different implementation
        //let's say for example PaymentInterface
   /*     $this->app->when(PaypalController::class)
                  ->needs(PaymentInterface::class)
                  ->give(PaypalService::class);
        $this->app->when(StripeController::class)
                  ->needs(PaymentInterface::class)
                  ->give(StripeService::class);*/
        //or if some class needs some variable value
        /*$this->app->when(Classname::class)
                  ->needs('$someVariable')
                  ->give('value it can be variable');*/
        //there are also giveTagged and giveConfig('app.timezone') (when u need to access a value from config files)


        //you can also resolve an array of classes using tag method
         //1) u need to first register them
        /*$this->app->tag([FirstReport::class, SecondReport::class], 'reports');
        //2) and u would resolve them like the following

        $this->app->bind(ReportAnalyzer::class, function($app){
            return new ReportAnalyzer($app->tagged('reports'));
        });*/

        //you may add additional code to a service before resolution

        /*$this->app->extend(Service::class, function($service, $app){
            return new ConfiguredService($service);
        });*/

        //you may also add dependencies before resolving the class

        /*$this->app->makeWith(SomeClass::class, ['id'=> 1]);*/


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() : void
        {
        Model::unguard();
    }
}
