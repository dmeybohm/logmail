#!/usr/bin/perl

# TODO: Make sure we don't run if apache is set up to interpret .pl files

use strict;
use Carp;
use Net::SMTP::Server;
use Net::SMTP::Server::Client;
#use Net::SMTP::Server::Relay;

my $port = 2525;
my $server = new Net::SMTP::Server('localhost', $port) ||
    croak("Unable to handle client connection: $!\n");

while(my $conn = $server->accept()) {
        # We can perform all sorts of checks here for spammers, ACLs,
        # and other useful stuff to check on a connection.

        # Handle the client's connection and spawn off a new parser.
        # This can/should be a fork() or a new thread,
        # but for simplicity...
        my $client = new Net::SMTP::Server::Client($conn) ||
        croak("Unable to handle client connection: $!\n");

        # Process the client.  This command will block until
        # the connecting client completes the SMTP transaction.
        $client->process || next;

        # In this simple server, we're just relaying everything
        # to a server.  If a real server were implemented, you
        # could save email to a file, or perform various other
        # actions on it here.
        #my $relay = new Net::SMTP::Server::Relay($client->{FROM},
        #                                     $client->{TO},
        #                                     $client->{MSG});

        log_message($client, $client->{MSG});
}

sub log_message {
        my ($client, $msg) = @_;
        open(my $fd, "| php enter-message.php") 
                or die("Failed executing enter-message.php.  Check that the path to php is in the PATH variable");
        print $fd $msg or die("Failed writing");
        close $fd;
}
