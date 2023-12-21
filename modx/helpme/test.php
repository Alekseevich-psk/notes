<?php
require_once('modxconnect.php');

$policy_name = 'Manager';
$policy_data = '{
	"about": true,
	"access_permissions": false,
	"actions": true,
	"change_password": true,
	"change_profile": true,
	"charsets": true,
	"class_map": true,
	"components": true,
	"content_types": true,
	"countries": true,
	"create": true,
	"credits": true,
	"customize_forms": true,
	"dashboards": false,
	"database": true,
	"database_truncate": false,
	"delete_category": false,
	"delete_chunk": false,
	"delete_context": false,
	"delete_document": false,
	"delete_eventlog": false,
	"delete_plugin": false,
	"delete_propertyset": false,
	"delete_role": false,
	"delete_snippet": false,
	"delete_template": false,
	"delete_tv": false,
	"delete_user": false,
	"directory_chmod": false,
	"directory_create": true,
	"directory_list": true,
	"directory_remove": true,
	"directory_update": true,
	"edit_category": false,
	"edit_chunk": false,
	"edit_context": false,
	"edit_document": true,
	"edit_locked": false,
	"edit_plugin": false,
	"edit_propertyset": false,
	"edit_role": false,
	"edit_snippet": false,
	"edit_template": false,
	"edit_tv": false,
	"edit_user": false,
	"element_tree": false,
	"empty_cache": true,
	"error_log_erase": true,
	"error_log_view": true,
	"events": false,
	"export_static": true,
	"file_create": true,
	"file_list": true,
	"file_manager": true,
	"file_remove": true,
	"file_tree": true,
	"file_update": true,
	"file_upload": true,
	"file_view": true,
	"flush_sessions": false,
	"frames": true,
	"help": true,
	"home": true,
	"import_static": true,
	"languages": false,
	"lexicons": false,
	"list": true,
	"load": true,
	"logout": true,
	"logs": true,
	"menus": false,
	"menu_reports": false,
	"menu_security": false,
	"menu_site": true,
	"menu_support": true,
	"menu_system": false,
	"menu_tools": false,
	"menu_user": true,
	"messages": true,
	"namespaces": false,
	"new_category": false,
	"new_chunk": false,
	"new_context": false,
	"new_document": true,
	"new_document_in_root": false,
	"new_plugin": false,
	"new_propertyset": false,
	"new_role": false,
	"new_snippet": false,
	"new_static_resource": false,
	"new_symlink": false,
	"new_template": false,
	"new_tv": false,
	"new_user": false,
	"new_weblink": false,
	"packages": true,
	"policy_delete": false,
	"policy_edit": false,
	"policy_new": false,
	"policy_save": false,
	"policy_template_delete": false,
	"policy_template_edit": false,
	"policy_template_new": false,
	"policy_template_save": false,
	"policy_template_view": false,
	"policy_view": false,
	"property_sets": false,
	"providers": false,
	"publish_document": true,
	"purge_deleted": true,
	"remove": true,
	"remove_locks": false,
	"resourcegroup_delete": false,
	"resourcegroup_edit": false,
	"resourcegroup_new": false,
	"resourcegroup_resource_edit": false,
	"resourcegroup_resource_list": false,
	"resourcegroup_save": false,
	"resourcegroup_view": false,
	"resource_duplicate": true,
	"resource_quick_create": true,
	"resource_quick_update": true,
	"resource_tree": true,
	"save": true,
	"save_category": false,
	"save_chunk": false,
	"save_context": false,
	"save_document": true,
	"save_plugin": false,
	"save_propertyset": false,
	"save_role": false,
	"save_snippet": false,
	"save_template": false,
	"save_tv": false,
	"save_user": false,
	"search": true,
	"settings": false,
	"sources": false,
	"source_delete": false,
	"source_edit": false,
	"source_save": false,
	"source_view": true,
	"steal_locks": true,
	"tree_show_element_ids": true,
	"tree_show_resource_ids": true,
	"undelete_document": true,
	"unlock_element_properties": true,
	"unpublish_document": true,
	"usergroup_delete": false,
	"usergroup_edit": false,
	"usergroup_new": false,
	"usergroup_save": false,
	"usergroup_user_edit": false,
	"usergroup_user_list": false,
	"usergroup_view": false,
	"view": true,
	"view_category": false,
	"view_chunk": false,
	"view_context": false,
	"view_document": true,
	"view_element": true,
	"view_eventlog": true,
	"view_offline": true,
	"view_plugin": false,
	"view_propertyset": false,
	"view_role": false,
	"view_snippet": false,
	"view_sysinfo": true,
	"view_template": true,
	"view_tv": false,
	"view_unpublished": true,
	"view_user": false,
	"workspaces": false
}';
$role_rank = 9;

$policy = $modx->newObject('modAccessPolicy');
$policy->fromArray(array(
    'name' => $policy_name,
    'template' => 1,
    'data' => $policy_data,
    'lexicon' => 'permissions'
));
$policy->save();
$policyID = $policy->get('id');

$role = $modx->newObject('modUserGroupRole');
$role->fromArray(array(
    'name' => $policy_name,
    'authority' => $role_rank
));
$role->save();

$group = $modx->newObject('modUserGroup');
$group->fromArray(array(
    'name' => $policy_name,
    'parent' => 0,
    'rank' => 0,
    'dashboard' => 1
));
$group->save();
$groupID = $group->get('id');

$contextaccess_web = $modx->newObject('modAccessContext');
$contextaccess_web->fromArray(array(
    'target' => 'web',
    'principal_class' => 'modUserGroup',
    'principal' => $groupID,
    'authority' => $role_rank,
    'policy' => $policyID
));
$contextaccess_web->save();

$contextaccess_mgr = $modx->newObject('modAccessContext');
$contextaccess_mgr->fromArray(array(
    'target' => 'mgr',
    'principal_class' => 'modUserGroup',
    'principal' => $groupID,
    'authority' => $role_rank,
    'policy' => $policyID
));
$contextaccess_mgr->save();




$modx->cacheManager->refresh();
echo 'Кэш обновлен!</br>';