@php
    echo "<?php".PHP_EOL;
@endphp

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class {{$config->modelNames->name}}Test extends DuskTestCase
{
    public function test{{$config->modelNames->name}}List()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visit(route('@if($config->prefixes->route) {{$config->prefixes->getRoutePrefixWith('.')}} @endif{{$config->modelNames->snakePlural}}.index'))
                    ->assertSee(@if($config->options->localized)__('models/{{ $config->modelNames->camelPlural }}.labels.backend.management') @else '{{$config->modelNames->humanPlural}}'@endif)
                    ->waitFor('{{$table_selector}}');
            $this->capture('index');
        });
    }

    public function test{{$config->modelNames->name}}Create()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visit(route('@if($config->prefixes->route) {{$config->prefixes->getRoutePrefixWith('.')}} @endif{{$config->modelNames->snakePlural}}.create'))
                    ->assertSee(@if($config->options->localized)__('models/{{ $config->modelNames->camelPlural }}.labels.backend.create') @else 'Create {{$config->modelNames->humanPlural}}' @endif);
            $this->capture('create');
        });
    }

    public function test{{$config->modelNames->name}}Edit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visit(route('@if($config->prefixes->route) {{$config->prefixes->getRoutePrefixWith('.')}} @endif{{$config->modelNames->snakePlural}}.edit',1))
                    ->assertSee(@if($config->options->localized)__('models/{{ $config->modelNames->camelPlural }}.labels.backend.edit') @else 'Edit {{$config->modelNames->human}}' @endif);
            $this->capture('edit');
        });
    }

    public function test{{$config->modelNames->name}}View()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visit(route('@if($config->prefixes->route) {{$config->prefixes->getRoutePrefixWith('.')}} @endif{{$config->modelNames->snakePlural}}.show',1))
                    ->assertSee(@if($config->options->localized)__('models/{{ $config->modelNames->camelPlural }}.labels.backend.show') @else '{{$config->modelNames->human}}  Details'@endif);
            $this->capture('view');
        });
    }
}
