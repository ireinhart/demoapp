define preseed_package ( $ensure, $module, $source = false ) {

  include preseed_package::setup

  $real_source = $source ? {
    false => "puppet:///modules/$module/$name.preseed",
    default => $source,
  }
  file { "/var/local/preseed/$name.preseed":
    source => $real_source,
    mode => 600,
    backup => false,
    require => File['/var/local/preseed'],
  }
  package { "$name":
    ensure => $ensure,
    responsefile => "/var/local/preseed/$name.preseed",
    require => File["/var/local/preseed/$name.preseed"],
  }
}
