<?php
namespace MagoArab\HideMassActions\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\AuthorizationInterface;
use Magento\Backend\Model\Auth\Session;

class MassActions extends \Magento\Backend\Block\Template
{
    protected $authorization;
    protected $authSession;

    public function __construct(
        Context $context,
        AuthorizationInterface $authorization,
        Session $authSession,
        array $data = []
    ) {
        $this->authorization = $authorization;
        $this->authSession = $authSession;
        parent::__construct($context, $data);
    }

    public function getAvailableActions()
    {
        // If not admin, return empty array
        if (!$this->isAdminUser()) {
            return [];
        }

        $allActions = [
            // Arabic Status Options
            ['value' => 'prepared', 'label' => 'تم التجهيز', 'permission' => 'MagoArab_HideMassActions::status_prepared'],
            ['value' => 'reserved', 'label' => 'حجز', 'permission' => 'MagoArab_HideMassActions::status_reserved'],
            ['value' => 'pre_walk_reservation', 'label' => 'مسبق Walk حجز', 'permission' => 'MagoArab_HideMassActions::status_pre_walk_reservation'],
            ['value' => 'today_deliveries', 'label' => 'تسليمات اليوم', 'permission' => 'MagoArab_HideMassActions::status_today_deliveries'],
            ['value' => 'shipped_today', 'label' => 'تم الشحن اليوم', 'permission' => 'MagoArab_HideMassActions::status_shipped_today'],
            ['value' => 'shipped', 'label' => 'تم الشحن', 'permission' => 'MagoArab_HideMassActions::status_shipped'],
            ['value' => 'be3ly_deliveries', 'label' => 'Be3ly تسليمات', 'permission' => 'MagoArab_HideMassActions::status_be3ly_deliveries'],
            ['value' => 'attempt_2', 'label' => 'محاولة 2', 'permission' => 'MagoArab_HideMassActions::status_attempt_2'],
            ['value' => 'mohamed_confirmations', 'label' => 'تاكيدات محمد', 'permission' => 'MagoArab_HideMassActions::status_mohamed_confirmations'],
            ['value' => 'nesreen_confirmations', 'label' => 'تاكيدات نسرين', 'permission' => 'MagoArab_HideMassActions::status_nesreen_confirmations'],
            ['value' => 'mariam_confirmations', 'label' => 'تاكيدات مريم', 'permission' => 'MagoArab_HideMassActions::status_mariam_confirmations'],
            ['value' => 'client_delay', 'label' => 'تآجيل العميل', 'permission' => 'MagoArab_HideMassActions::status_client_delay'],
            ['value' => 'pre_be3ly_reservation', 'label' => 'مسبق Be3ly حجز', 'permission' => 'MagoArab_HideMassActions::status_pre_be3ly_reservation'],
            ['value' => 'processing', 'label' => 'جاري التجهيز', 'permission' => 'MagoArab_HideMassActions::status_processing'],
            ['value' => 'printing', 'label' => 'طباعه', 'permission' => 'MagoArab_HideMassActions::status_printing'],
            ['value' => 'todays_returns', 'label' => 'مرتجعات اليوم', 'permission' => 'MagoArab_HideMassActions::status_todays_returns'],

            // English Status Options
            ['value' => 'canceled', 'label' => 'Canceled', 'permission' => 'MagoArab_HideMassActions::status_canceled'],
            ['value' => 'closed', 'label' => 'Closed', 'permission' => 'MagoArab_HideMassActions::status_closed'],
            ['value' => 'complete', 'label' => 'Complete', 'permission' => 'MagoArab_HideMassActions::status_complete'],
            ['value' => 'suspected_fraud', 'label' => 'Suspected Fraud', 'permission' => 'MagoArab_HideMassActions::status_suspected_fraud'],
            ['value' => 'on_hold', 'label' => 'On Hold', 'permission' => 'MagoArab_HideMassActions::status_on_hold'],
            ['value' => 'payment_review', 'label' => 'Payment Review', 'permission' => 'MagoArab_HideMassActions::status_payment_review'],
            ['value' => 'pending', 'label' => 'Pending', 'permission' => 'MagoArab_HideMassActions::status_pending'],
            ['value' => 'pending_payment', 'label' => 'Pending Payment', 'permission' => 'MagoArab_HideMassActions::status_pending_payment'],

            // Mass Actions
            ['value' => 'change_status', 'label' => 'Change Order Status', 'permission' => 'MagoArab_HideMassActions::change_status'],
            ['value' => 'print_pdf', 'label' => 'Print PDF Orders', 'permission' => 'MagoArab_HideMassActions::print_pdf_orders'],
            ['value' => 'print_invoices', 'label' => 'Print Invoices', 'permission' => 'MagoArab_HideMassActions::print_invoices'],
            ['value' => 'print_packing_slips', 'label' => 'Print Packing Slips', 'permission' => 'MagoArab_HideMassActions::print_packing_slips'],
            ['value' => 'print_credit_memos', 'label' => 'Print Credit Memos', 'permission' => 'MagoArab_HideMassActions::print_credit_memos'],
            ['value' => 'print_all', 'label' => 'Print All', 'permission' => 'MagoArab_HideMassActions::print_all'],
            ['value' => 'print_shipping_labels', 'label' => 'Print Shipping Labels', 'permission' => 'MagoArab_HideMassActions::print_shipping_labels'],
            ['value' => 'cancel', 'label' => 'Cancel', 'permission' => 'MagoArab_HideMassActions::cancel'],
            ['value' => 'hold', 'label' => 'Hold', 'permission' => 'MagoArab_HideMassActions::hold'],
            ['value' => 'unhold', 'label' => 'Unhold', 'permission' => 'MagoArab_HideMassActions::unhold']
        ];

        // Filter actions based on user permissions
        return array_filter($allActions, function($action) {
            return $this->authorization->isAllowed($action['permission']);
        });
    }

    private function isAdminUser()
    {
        $user = $this->authSession->getUser();
        return $user && $user->getRole()->getRoleName() === 'Administrators';
    }
}