@php
    echo "<?php".PHP_EOL;
@endphp

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * @return void
     */
    public function testLoginPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'admin@admin.com')
                    ->type('password', 'password')
                    ->assertSee(config('app.name'));
            $this->capture('login');
        });
    }
}
