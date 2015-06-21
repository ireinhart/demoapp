node demoapp inherits default {

  class { 'php':
    mysql_password => 'root',
    mysql_sqlfile  => '/vagrant/demoapp.sql',
    document_root  => '/vagrant/web/',
    server_name    => 'demoapp.dev',
  }

}

node 'demoapp.dev' inherits demoapp  {}
