<?php

class LoginAttempts extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $loginAttemptID;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $loginAttemptUserID;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $tried_at;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('loginAttemptUserID', 'Users', 'userID', ['alias' => 'Users']);
    }

    /**
     * Method to set the value of field loginAttemptID
     *
     * @param integer $loginAttemptID
     * @return $this
     */
    public function setLoginAttemptUserID($loginAttemptUserID)
    {
        $this->loginAttemptUserID = $loginAttemptUserID;

        return $this;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'login_attempts';
    }
    
    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Find all login attempts made by user 
     *
     * @param object  user
     * @return LoginAttempts[]
     */
    public static function totalAttempts($user)
    {
        return count(parent::find(array(
            "conditions" => "loginAttemptUserID = ?1",
            "bind"       => array(1 => $user->getUserID())
            )));
    }

    /**
     * Check if the user can try to login again or not
     *
     * @param object  user
     * @return LoginAttempts[]
     */
    public static function attempts($user)
    {
        return self::totalAttempts($user) < 5 ? true : false;
    }

    /**
     * Return remaining attempts to login
     *
     * @param object  user
     * @return LoginAttempts[]
     */
    public static function remainingAttempts($user)
    {
        return (5 - self::totalAttempts($user));
    }

    /**
     * Register a new attempt to login
     *
     * @param object  user
     * @return LoginAttempts[]
     */
    public static function registerAttempts($user)
    {   
        $attempt = new LoginAttempts();
        $attempt->setLoginAttemptUserID($user->getUserID());
        return $attempt->save();
    }

    /**
     * Clear all attempts to login
     *
     * @param object  user
     * @return LoginAttempts[]
     */
    public static function clearAttempts($user)
    {
        return self::find('loginAttemptUserID =' . $user->getUserID())->delete();
    }

            

}
