<?php

class Grizzly_Orderedit_Block_Adminhtml_Orderedit_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('ordereditGrid');
      $this->setDefaultSort('orderedit_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('orderedit/orderedit')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('orderedit_id', array(
          'header'    => Mage::helper('orderedit')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'orderedit_id',
      ));

//      $this->addColumn('title', array(
//          'header'    => Mage::helper('orderedit')->__('Title'),
//          'align'     =>'left',
//          'index'     => 'title',
//      ));

	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('orderedit')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */
      
      $this->addColumn('order_id', array(
          'header'    => Mage::helper('orderedit')->__('Order Id'),
          'align'     =>'left',
          'width'     => '80px',
          'index'     => 'order_id',
      ));
      
      $this->addColumn('usernameadmin', array(
          'header'    => Mage::helper('orderedit')->__('User Name'),
          'align'     =>'left',
          'width'     => '80px',
          'index'     => 'usernameadmin',
      ));
      
      $this->addColumn('user_id', array(
          'header'    => Mage::helper('orderedit')->__('User Id'),
          'align'     =>'left',
          'width'     => '20px',
          'index'     => 'user_id',
      ));
      
   
      $this->addColumn('statuslogord', array(
          'header'    => Mage::helper('orderedit')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'statuslogord',
          
      ));
	  
      $this->addColumn('content', array(
          'header'    => Mage::helper('orderedit')->__('Content'),
          'align'     => 'left',
          'width'     => '280px',
          'index'     => 'content',
       ));
      
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('orderedit')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('orderedit')->__('View'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('orderedit')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('orderedit')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('orderedit_id');
        $this->getMassactionBlock()->setFormFieldName('orderedit');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('orderedit')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('orderedit')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('orderedit/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}