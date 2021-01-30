<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Anjulata\Post\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Post extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('anjulata_post', 'post_id');
    }
}
