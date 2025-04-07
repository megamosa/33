<?php
namespace MagoArab\HideMassActions\Plugin\Block\Adminhtml\Sales\Order;

use Magento\Backend\Block\Widget\Grid\Extended as GridExtended;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Grid
{
    protected $authorization;
    protected $scopeConfig;

    public function __construct(
        AuthorizationInterface $authorization,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->authorization = $authorization;
        $this->scopeConfig = $scopeConfig;
    }

    public function beforePrepareMassaction(GridExtended $subject)
    {
        // Check if module is enabled in configuration
        $isEnabled = $this->scopeConfig->getValue(
            'magoarab_hidemassactions/general/enabled',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        if (!$isEnabled) {
            return null;
        }

        // Define mass actions and their corresponding ACL resources
        $massActions = [
            'cancel' => 'sales_order_cancel',
            'hold' => 'sales_order_hold',
            'unhold' => 'sales_order_unhold',
            'invoice' => 'sales_order_invoice',
            'ship' => 'sales_order_ship',
            'creditmemo' => 'sales_order_creditmemo'
        ];

        foreach ($massActions as $action => $resource) {
            if (!$this->authorization->isAllowed($resource)) {
                $subject->getMassactionBlock()->removeItem($action);
            }
        }

        return null;
    }
}