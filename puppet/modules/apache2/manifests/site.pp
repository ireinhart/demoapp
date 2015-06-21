define apache2::site ( $sitename = $title,
                       $ensure = $apache2::ensure_site,
                        ) {

  Exec { path => '/usr/bin:/bin:/usr/sbin:/sbin' }

  case $ensure {
      'present': {
          exec { "a2ensite $sitename":
              unless  => "test -f $apache2::params::apache2_sites-enabled/$sitename",
              require => Class['apache2::install'],
              notify  => Service[$apache2::params::sname],
          }
      }

      'absent': {
          exec { "a2dissite $sitename":
              onlyif  => "test -f $apache2::params::apache2_sites-enabled/*$sitename",
              require => Class['apache2::install'],
              notify  => Service[$apache2::params::sname],
          }
      }

      default: { fail("Unknown variable ensure: $ensure")  }
  }

  include 'apache2::service'

}
