 <?php defined('SYSPATH') or die('No direct script access.');
 /**
  * 
  * @author Sokolov
  *
  */
class Model_Email
{
 /**
  * @author  Sokolov
  * @param unknown $to = "Указываем кому отправляется письмо, возможно задать массив email адресов, организовав массовую рассылку"
  * @param unknown $from = "Кто отправлет письмо"
  * @param unknown $subject ="Тема сообщения"
  * @param unknown $message = "Текст сообщения"
  * @return boolean 
  */
 public function sendemail($to, $subject, $message)
   {
     try
      {  
      	$res = FALSE;
      	if (is_array($to))
      	{
      		for($i = 0;$i < count($to);$i++)
      		{
      			if (is_string($to[i]))
      			{
      			  $count = Email::send($to[i],'cafeteria-ordering-system2013@yandex.ru', $subject, $message, $html = false);
      			  $res = TRUE;
      			}
      		}
      	}
      	if (is_string($to))
      	{
      	   $count = Email::send($to,'cafeteria-ordering-system2013@yandex.ru', $subject, $message, $html = false);
           $res = TRUE;
      	}
      	return $res;
      }
        catch (Exception $e)
        {
           echo $e->getMessage();
           return FALSE;
        }
    }	
}