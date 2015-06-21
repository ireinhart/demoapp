class php::config::timezone {

  # setup php timezone
  file { '/etc/php5/mods-available/timezone.ini':
    source   => 'puppet:///modules/php/timezone.ini',
    require  => Package['apache2', 'libapache2-mod-php5', 'php5-cli'],
  }

  exec { 'php5enmod timezone':
    path        => '/bin:/usr/bin:/usr/sbin/',
    cwd         => '/root/',
    command     => 'php5enmod timezone',
    user        => root,
    notify   => Service['apache2'],
    require  => File['/etc/php5/mods-available/timezone.ini'],
  }

}
