<?php
//User logged in or not.if logged in get user's data;
function get_active_user(){

    $t = &get_instance();

    $user = $t->session->userdata("user");

    if($user)
        return $user;
    else
        return false;

}

//Checking if User is 'manager' or 'user';
function isManager(){

    $t = &get_instance();

    $user = $t->session->userdata("user");

    return true;

    if($user->role == "Manager")
        return true;
    else
        return false;
//    $user = get_active_user();
//    $user_roles = get_user_roles();

}

//Getting user roles;
function get_user_roles(){

    $t = &get_instance();
//    setUserRoles();
    return $t->session->userdata("user_roles");
}

//Setting a helper to get all user_roles table and set it to session;
function setUserRoles(){

    $t = &get_instance();

    $t->load->model("user_role_model");
    $user_roles = $t->user_role_model->get_all(
        array(
            "isActive" => 1
        )
    );

    $roles = array();
    foreach ($user_roles as $role){
        $roles[$role->id] = $role->permissions;
    }

    $t->session->set_userdata("user_roles", $roles);

}

//To arrange permissions we need to get all controllers to give auth on controllers to users;
function getControllerList(){
    $t = &get_instance();
    $controllers = array();
    $t->load->helper("file");
    $files = get_dir_file_info(APPPATH. "controllers", FALSE);

    foreach (array_keys($files) as $file){
        if ($file !== "index.html"){
            $controllers[] = strtolower(str_replace(".php", '', $file));

        }
    }

    return $controllers;
}