<?php
class SSHClient{

	protected $connection;

	public function run_cmd($cmd){
		ssh2_exec($this->connection, $cmd);
	}

	public function __construct(array $options){
		$this->connection = ssh2_connect($options['host'], $options['port'], $options['crypt']);
		ssh2_auth_pubkey_file($this->connection, $options['user'], $options['pub'], $options['priv']);
	}
}
?>
