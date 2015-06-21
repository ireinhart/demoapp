class php(
  $mysql_password = 'root',
  $mysql_sqlfile  = '/vagrant/public/db.sql',
  $document_root  = '/vagrant',
  $server_name    = 'local.dev',
) {

  include php::base
  include php::install
  include php::config

  Class['php::base'] -> Class['php::install'] -> Class['php::config']
}
