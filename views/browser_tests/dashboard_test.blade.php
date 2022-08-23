@php
    echo "<?php".PHP_EOL;
@endphp

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DashboardTest extends DuskTestCase
{
    /**
     * @return void
     */
    public function testDashboardPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visit(route('home'))
                    ->assertSee(__('You are logged in!'));
            $this->capture('dashboard');
        });
    }
}
