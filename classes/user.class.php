<?php

require_once(__DIR__ . '/../database/client.php');
require_once(__DIR__ . '/../database/departments.php');

class User
{
    public int $id;
    public string $username;
    public string $email;
    public int $level;

    public function __construct(int $id, string $username, string $email, int $level) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->level = $level;
    }

    static function getUsersAdmin(PDO $db): array {
        $users = getAllUsers($db);

        $res = array();
        foreach ($users as $user) {
            $res[] = new User($user['uid'], $user['username'], $user['email'], $user['permissionLevel']);
        }

        return $res;
    }

    static function getUser(PDO $db, int $uid): User {
        $user = getUser($db, $uid);

        return new User($user['uid'], $user['username'], $user['email'], $user['permissionLevel']);
    }

    static function updateUserPermissions(PDO $db, int $uid, int $level): int {
        return updateUserPerms($db, $uid, $level);
    }

    static function getAgentDepartments(PDO $db, int $aid): array {
        $departments =  getDepartmentsAgent($db, $aid);

        $result = array();
        foreach ($departments as $department) {
            $result[] = $department['department'];
        }

        return $result;
    }

    static function getAgentsFromDepartment(PDO $db, string $department): array {
        $agents = getAgentsByDepartment($db, $department);

        $res = array();
        foreach ($agents as $agent) {
            $res[] = new User($agent['uid'], $agent['username'], $agent['email'], $agent['permissionLevel']);
        }

        return $res;
    }

    static function toggleAgentDepartment(PDO $db, int $aid, string $department): array {
        return toggleDepartment($db, $aid, $department);
    }
}