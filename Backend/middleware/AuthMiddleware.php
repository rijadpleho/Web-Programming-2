<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {

    public function verifyToken() {

        $token = Flight::request()->getHeader('Authentication');

        if (!$token) {
            Flight::halt(401, 'Missing authentication header');
        }

        try {
            $decoded = JWT::decode(
                $token,
                new Key(Config::JWT_SECRET(), 'HS256')
            );
            Flight::set('user', $decoded->user);
            Flight::set('jwt_token', $token);

            return true;

        } catch (Exception $e) {
            Flight::halt(401, 'Invalid or expired token');
        }
    }

    public function authorizeRole($role) {
        $this->authorizeRoles([$role]);
    }

    public function authorizeRoles($roles) {

        if (!Flight::get('user')) {
            $this->verifyToken();
        }

        $user = Flight::get('user');

        if (!isset($user->role)) {
            Flight::halt(403, 'Forbidden: user role missing');
        }

        if (!in_array($user->role, $roles)) {
            Flight::halt(403, 'Forbidden: role not allowed');
        }
    }
}
