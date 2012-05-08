#!/usr/bin/perl

# TODO: Make sure we don't run if apache is set up to interpret .pl files

use strict;
use Carp;
use Net::SMTP::Server;
use Net::SMTP::Server::Client2;
use File::Basename;
use Cwd;

my $path = dirname(dirname(Cwd::abs_path(__FILE__))) . "/";
chdir($path) || croak("Unable to change dir");

my $port = 2525;
my $server = Net::SMTP::Server->new('127.0.0.1', $port) ||
    croak("Unable to handle client connection: $!\n");
print "Listening on localhost:$port\n";

my $conn;
while($conn = $server->accept()) {
   if (!fork) { 
	handle_client($conn);
	$conn->close;
	exit;
   }
   $conn->close;
};
          
sub handle_client {
	my $conn = shift;
	my $count = 'aaa';
	my $client = new Net::SMTP::Server::Client2($conn) ||
	croak("Unable to handle client: $!\n");

	$client->greet; # this is new

	while($client->get_message){ # this is different
		log_message($client, $client->{MSG});
		$client->okay("message saved for relay"); # this is new
	}
}

sub log_message {
	my ($client, $msg) = @_;
	open(my $fd, "| ./sendmail") 
		or die("Failed executing ./sendmail.  Check that the path to php is in the PATH variable");
	print $fd $msg or die("Failed writing");
	close $fd;
}
