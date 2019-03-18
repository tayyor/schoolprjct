<?php
/**
 * Created by PhpStorm.
 * User: Musty
 * Date: 1/7/18
 * Time: 1:18 PM
 */

namespace App\Core\Requests;

use App\Core\Helpers;
use App\Core\Returns;
use Illuminate\Foundation\Application;
use App\User;
use League\OAuth2\Server\Exception\OAuthServerException;

class LoginProxy
{
    const REFRESH_TOKEN = 'refreshToken';

    private $apiConsumer;

    private $db;

    public function __construct(Application $app) {

        $this->apiConsumer = $app->make('apiconsumer');
        $this->db = $app->make('db');
    }

    /**
     * Attempt to create an access token using user credentials
     *
     * @param string $email
     * @param string $password
     */
    public function attemptLogin($email, $password, $scope='monitor')
    {
//        dd(User::where('email', $email)->get()->first());
        $user = User::where('email', $email)->get()->first();

        if (!is_null($user)) {
            return $this->proxy('password', [
                'username' => $email,
                'password' => $password
            ], $scope);
        }

        return Returns::validationError(['email' => 'User does not exist, Try Again']);
//        throw new InvalidCredentialsException();
    }

    public function attemptRefresh($refreshToken, $scope='monitor')
    {
        return $this->proxy('refresh_token', [
            'refresh_token' => $refreshToken
        ], $scope);
    }

    /**
     * Proxy a request to the OAuth server.
     *
     * @param string $grantType what type of grant type should be proxied
     * @param array $data the data to send to the server
     */
    public function proxy($grantType, array $data = [], $scope='')
    {
        $data = array_merge($data, [
            'client_id'     => env('PASSWORD_CLIENT_ID'),
            'client_secret' => env('PASSWORD_CLIENT_SECRET'),
            'grant_type'    => $grantType,
            'scope'         => $scope
        ]);
        try {
            //Helpers::logDNA($data);
            $response = $this->apiConsumer->post('/oauth/token', $data);
			//dd($response);
            if (!$response->isSuccessful()) {
                return Returns::validationError(['password'=>'Access denied. Check credentials']);
                //throw new InvalidCredentialsException();
            }
            $response_content = json_decode($response->getContent(), TRUE);
            //then request for user data please.
            $response_user = $this->apiConsumer->get(route('api.auth.user'), [], [
                'Authorization'=>'Bearer '. $response_content['access_token']
            ]);
        }
        catch(OAuthServerException $oathException){
            return Returns::validationError(['password'=>'Check credentials: '.$oathException->getMessage()]);
        }
        return Returns::ok(array_merge($response_content,[
            'user'=>json_decode($response_user->getContent(), TRUE)
        ]));
    }

    /**
     * Logs out the user. We revoke access token and refresh token.
     * Also instruct the client to forget the refresh cookie.
     */
    public function logout($accessToken)
    {
        $this->db
            ->table('oauth_refresh_tokens')
            ->where('access_token_id',$accessToken)
            ->update([
                'revoked' => true
            ]);;

    }
}