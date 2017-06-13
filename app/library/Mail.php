<?php
use Phalcon\Mvc\User\Component,
	Phalcon\Mvc\View;
/**
 *
 * Sends e-mails based on pre-defined templates
 */
class Mail extends Component
{
	protected $_transport;
	
	
	/**
	 * Applies a template to be used in the e-mail
	 *
	 * @param string $name
	 * @param array $params
	 */
	public function getTemplate($name, $params)
	{
		
		$content = new \Crossjoin\PreMailer\HtmlString(
			$this->view->getRender(
				'email',
				$name, 
				$params,
				function($view){
					$view->setRenderLevel(View::LEVEL_LAYOUT);
				}
			)
		);
		return $content;
		// return $this->view->getRender('email', $name, $params, function($view){
		// 	$view->setRenderLevel(View::LEVEL_LAYOUT);
		// });
		// return $view->getContent();
	}
	/**
	 * Sends e-mails via gmail based on predefined templates
	 *
	 * @param array $to
	 * @param string $subject
	 * @param string $name
	 * @param array $params
	 */
	public function send($to, $subject, $name, $params)
	{
		//Settings
		$mailSettings = $this->config->mail;
		$template = $this->getTemplate($name, $params);
		// Create the message

		$mail = new PHPMailer;

		$mail->isSMTP();                                 			     // Set mailer to use SMTP 
		$mail->CharSet = 'UTF-8';                           			     // Set mailer to use UTF-8 encoding
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages

		$mail->SMTPDebug = 0;
		$mail->Host = $mailSettings->get('smtp')->get('server');  	 	     // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               				 // Enable SMTP authentication
		$mail->Username = $mailSettings->get('smtp')->get('username');       // SMTP username
		$mail->Password = getenv('SMTP_PASSWORD');     // SMTP password
		$mail->SMTPSecure = $mailSettings->get('smtp')->get('security');     // Enable TLS encryption, `ssl` also accepted
		$mail->Port = $mailSettings->get('smtp')->get('port');     			 // TCP port to connect to


		$mail->setFrom($mailSettings->get('fromEmail'), 'MagazineManager');
		$mail->addAddress($to);



        $mail->Subject = $subject;
		$mail->Body    = $template->getHtml();
		$mail->AltBody = $template->getText();
		$mail->isHTML(true);                                            	 // Set email format to HTML

		// var_dump($mail->send());exit;


		if(!$mail->send()) {
		    return json_encode(array('status' => false, 'message' => 'Ocorreu algum erro, seu email nao pode ser enviado! :/', 'Mailer Error: '=> $mail->ErrorInfo));
		} else {
		    return json_encode(array('status' => 'ok', 'message' => 'Foi enviado um email com as instrucoes para redefinir sua senha.'));
		}

	}
}