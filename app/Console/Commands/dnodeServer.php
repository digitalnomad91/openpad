<?php

namespace App\Console\Commands;

//namespace Vendor\DNode\DNode;
use React\EventLoop\StreamSelectLoop;
use DNode\DNode;
use Illuminate\Console\Command;


class dnodeServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:dnodeServer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the dnodeServer for listening to events from NodeJS.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $loop = new StreamSelectLoop();
        // Create a DNode server
        $server = new DNode($loop, new Zinger());
        $server->listen(7070);
        $loop->run();
    }
}





// This is the class we're exposing to DNode
class Zinger
{
    // Public methods are made available to the network
    public function zing($n, $cb)
    {
        
        $controller = app()->make('App\Http\Controllers\PageController');
        $output = app()->call([$controller, 'savePage'], [$n]);
        
        // Dnode is async, so we return via callback
        $cb($output);
    }
}

