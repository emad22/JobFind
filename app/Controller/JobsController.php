<?php
class JobsController extends AppController{
  public $name ='Jobs';
  /*
  *Default Index Method
  */
  public function index(){
    $options =array(
      'order' =>array('category.name'=>'DESC')
    );
    //Get Cagetories
    $categories = $this->Job->Category->find('all',$options);
    $this->set('categories',$categories);


    //Set Query Options
    $options = array(
              'order' =>array('Job.created' =>'DESC'),
              'limit' => 3
            );
    // Get Job Info
    $jobs=$this->Job->find('all',$options);
    //Set Title
    $this->Set('title_for_layout','JobFinds | Welcome');

    $this->set('jobs',$jobs);
  }

  /*
  *Browse Method
  */
  public function browse($category = null){


    //Init Conditions Array
    $conditions[] =array();

    //Check keywords Filter
    if($this->request->is('post')){
      if(!empty($this->request->data('keywords'))){
        $conditions[] = array(
          'OR'=> array(
          'Job.title LIKE' => '%' . $this->request->data('keywords') . '%',
          'Job.description LIKE' => '%' . $this->request->data('keywords') . '%'
        )
      );
      }
    }

    //State Filter
    if (!empty($this->request->data('state')) && $this->request->data('state') !='select state' ) {
      $conditions[] =array(
        'Job.state LIKE' => "%" . $this->request->data('state') . "%"
      );
    }



    //Category Filter
    if (!empty($this->request->data('category')) && $this->request->data('category') !='select category' ) {
      //Match Category
      $conditions[] =array(
        'Job.category_id LIKE' => "%" . $this->request->data('category') . "%"
      );
    }

/*
*For Category Tags After
* textbox , select box
*/


    //Set Category Query Options
    $options =array(
      'order' =>array('Category.name'=>'ASC')
    );
    //Get Cagetories
    $categories = $this->Job->Category->find('all',$options);
    $this->set('categories',$categories);


    if ($category != null) {
      //Math category
      $conditions[] =array(
        'Job.category_id LIKE ' =>"%" .$category. "%"
      );
    }

    //Set Category Query Options
    $options = array(
              'order' =>array('Job.created' =>'ASC'),
              'conditions'=>$conditions
            );



    // Get Job Info
    $jobs=$this->Job->find('all',$options);

    //Set Title
    $this->Set('title_for_layout','JobFinds | Browse For Ajob');
    $this->set('jobs',$jobs);
  }

  /*
  *View Single jobs
  */
  public function View($id){
    if (!$id) {
      throw new NotFoundException(__('Invalid Job Listing'));
    }
    $job =$this->Job->findById($id);
    if (!$job) {
      throw new NotFoundException(__('Invalid Job Listing'));
    }
    //Set Title
    $this->Set('title_for_layout',$job['Job']['title']);
    $this->Set('job',$job);
  }

  /*
  *Add job
  */
  public function add(){
    //Get Category For select List
    $options =array(
      'order' =>array('Category.name'=>'ASC')
    );
    //Get Cagetories
    $categories = $this->Job->Category->find('list',$options);
    $this->set('categories',$categories);


    //Get types For Select List
    $types = $this->Job->Type->find('list');
    $this->set('types',$types);


    if ($this->request->is('post')) {
      $this->Job->create();
      //Save Logged User ID
      $this->request->data['Job']['user_id'] = $this->Auth->user('id');
      if ($this->Job->save($this->request->data)) {
        $this->Session->setFlash(__('Your Job Has been Listed'));
        return $this->redirect(array('action' =>  'index'));
      }
      $this->Session->setFlash(__('Unable To Add Your Job'));
    }
    $this->Set('title_for_layout','JobFinds | Add a job');
  }

  /*
  *Edit Category
  */
  public function edit($id){
    //Get Category For select List
    $options =array(
      'order' =>array('Category.name'=>'ASC')
    );
    //Get Cagetories
    $categories = $this->Job->Category->find('list',$options);
    $this->set('categories',$categories);


    //Get types For Select List
    $types = $this->Job->Type->find('list');
    $this->set('types',$types);

    if (!$id) {
      throw new NotFoundException(_('Invalid Job Listing'));
    }
    $job =$this->Job->findById($id);
    if (!$job) {
      throw new NotFoundException(_('Invalid Job Listing'));
    }


    if ($this->request->is(array('job','put'))) {
      $this->Job->id=$id;
      //Save Logged User ID
      $this->request->data['Job']['user_id'] = 2;
      if ($this->Job->save($this->request->data)) {
        $this->Session->setFlash(__('Your Job Has been Updated'));
        return $this->redirect(array('action' =>  'index'));
      }
      $this->Session->setFlash(__('Unable To Update Your Job'));
    }
    if (!$this->request->data) {
      $this->request->data=$job;
    }
    $this->Set('title_for_layout','JobFinds | Update a job');
  }


  /*
  *Delete Job
  */
  public function delete($id){
    if($this->request->is('Get')){
      throw new MethodNotAllowedException();
    }
    if ($this->Job->delete($id)) {
      $this->Session->setFlash(
        __('The Job With ID: %s has been deleted.',h($id))
      );
      return $this->redirect(array('action'=>'index'));
    }
  }


}
 ?>
