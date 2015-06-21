class preseed_package::setup {

  file { '/var/local/preseed':
    ensure  => 'directory',
  }

}