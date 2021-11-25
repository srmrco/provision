
<?php if ($this->ssl_enabled && $this->ssl_key) : ?>

server {
  include      <?php print "{$server->include_path}"; ?>/fastcgi_ssl_params.conf;
  limit_conn   gulag 32;
  listen       <?php print "{$ip_address}:{$http_ssl_port}"; ?>;
  server_name  <?php print $this->uri . ' ' . implode(' ', $this->aliases); ?>;
  root         /var/www/nginx-default;
  index        index.html index.htm;
  ssl                        on;
  ssl_certificate            <?php print $ssl_cert; ?>;
  ssl_certificate_key        <?php print $ssl_cert_key; ?>;
  ssl_protocols              SSLv3 TLSv1 TLSv1.1 TLSv1.2;
  ssl_ciphers                RC4:HIGH:!ADH:!MD5;
  ssl_prefer_server_ciphers  on;
  keepalive_timeout          70;
  ### Dont't reveal Aegir front-end URL here.
}

<?php endif; ?>

<?php
  // Generate the standard virtual host too.
  include('http/nginx/vhost_disabled.tpl.php');
?>
