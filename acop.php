<?php

require_once 'acop.civix.php';
// phpcs:disable
use CRM_Acop_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function acop_civicrm_config(&$config) {
  _acop_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function acop_civicrm_xmlMenu(&$files) {
  _acop_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function acop_civicrm_install() {
  _acop_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function acop_civicrm_postInstall() {
  _acop_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function acop_civicrm_uninstall() {
  _acop_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function acop_civicrm_enable() {
  _acop_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function acop_civicrm_disable() {
  _acop_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function acop_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _acop_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function acop_civicrm_managed(&$entities) {
  _acop_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function acop_civicrm_caseTypes(&$caseTypes) {
  _acop_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function acop_civicrm_angularModules(&$angularModules) {
  _acop_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function acop_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _acop_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function acop_civicrm_entityTypes(&$entityTypes) {
  _acop_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function acop_civicrm_themes(&$themes) {
  _acop_civix_civicrm_themes($themes);
}

function acop_civicrm_alterReportVar($type, &$columns, &$form) {
  if ('CRM_Report_Form_Contribute_Summary' == get_class($form) && $type == 'columns') {
    $columns['civicrm_contribution']['filters']['payment_instrument_id'] = [
      'title' => ts('Payment Method'),
      'operatorType' => CRM_Report_Form::OP_MULTISELECT,
      'options' => CRM_Contribute_BAO_Contribution::buildOptions('payment_instrument_id', 'search'),
      'type' => CRM_Utils_Type::T_INT,
    ];
  }
}

/**
 * Implements hook_civicrm_validateForm().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_validateForm/
 */
function acop_civicrm_validateForm($formName, &$fields, &$files, &$form, &$errors) {
  if ($formName === 'CRM_Contribute_Form_Contribution_Main' && $form->getVar('_id') == '2') {
    if (empty($fields['price_5']) && empty($fields['price_14']) && empty($fields['price_10']) && empty($fields['price_13']) && empty($fields['price_12'])) {
      $errors['price_5'] = E::ts('You Must Select at least one membership option');
    }
  }
}

/**
 * Implements hook_civicrm_buildForm().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_buildForm/
 */
function acop_civicrm_buildForm($formName, &$form) {
  if ($formName === 'CRM_Contribute_Form_Contribution_Main' && $form->getVar('_id') == '2') {
    Civi::resources()->addScriptFile('biz.jmaconsulting.acop', 'js/acop_membership_form.js');
  }
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function acop_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
//function acop_civicrm_navigationMenu(&$menu) {
//  _acop_civix_insert_navigation_menu($menu, 'Mailings', array(
//    'label' => E::ts('New subliminal message'),
//    'name' => 'mailing_subliminal_message',
//    'url' => 'civicrm/mailing/subliminal',
//    'permission' => 'access CiviMail',
//    'operator' => 'OR',
//    'separator' => 0,
//  ));
//  _acop_civix_navigationMenu($menu);
//}
