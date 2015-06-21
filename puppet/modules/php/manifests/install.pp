class php::install {
  $ensure_installed = [
    'tzdata',
    'mysql-client',
    'mysql-server',
    'php5-cli',
    'php5-mysql',
    'libapache2-mod-php5',
    'php5-xdebug',
    'php5-curl',
    'php5-apcu',
    'php5-mcrypt'
  ]

  package {
    $ensure_installed:
      ensure => 'installed'
  }

  preseed_package {
    'phpmyadmin':
      ensure => 'present',
      module => 'php'
  }
}
