<?php

namespace Controller;

use View\HTMLTemplate;
use View\HTMLView;
use Model\Repository\Filter;
use Model\Repository\Condition;
use Model\Entity\Journal;
use Model\Repository\JournalRepository;
use Model\Factory\JournalFactory;
use View\BootstrapHTMLGenerator;

class JournalController extends Controller
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    function indexAction($request)
    {

        $this->loadTemplate('journal/journalList.twig');

        $journalRepository = new JournalRepository($this->database);

        // $insertJournal = new \Model\Entity\Journal(null,'title','content');
        // $journalRepository->update($insertJournal);


        // $journal = $journalRepository->findById(1);
        // $journalRepository->remove($journal);

        // $filter = new Filter($this->database);
        // $filter->addCondition(new Condition('content','<>','content'));
        // $journals = $journalRepository->findByFilter($filter);

        $journals = $journalRepository->findAll();

        $twigContext = array(
            'journals' => $journals
            );

        return $twigContext;

    }

    public function journalAction($request)
    {
        $this->loadTemplate('journal/journal.twig');

        $journalRepository = new JournalRepository($this->database);

        $id = $request->matches['id'];
        $journal = $journalRepository->findById($id);

        $twigContext = array(
            'journal' => $journal
            );

        return $twigContext;
    }

    public function formAction($request, $entity = null)
    {
        $this->loadTemplate('journal/journalForm.twig');

        $bootstrapHTMLGenerator = new BootstrapHTMLGenerator();

        $form = $bootstrapHTMLGenerator->getForm('journal','');

        $buttonText = 'Send';
        if ($entity!=null && $entity['id']!=null ) {
            // #@todo: add $bootstrapHTMLGenerator->getHidden()
            $buttonText = 'Update';
        }

        $title = $entity!=null ? $entity['title'] : null;
        $form->addChildren($bootstrapHTMLGenerator->getTextfield('title','Title',$title,'Title',null,true,['autofocus'=>true]));

        $content = $entity!=null ? $entity['content'] : null;
        $form->addChildren($bootstrapHTMLGenerator->getTextarea('content','Content',$content,'Content',null,true));

        $form->addChildren($bootstrapHTMLGenerator->getButton('submit',null,'Send'));

        $twigContext = array('form' => $form->render());

        return $twigContext;

    }

    public function submitAction($request)
    {
        $id = array_key_exists('id', $request->POST) ? $request->POST['id']:null;
        $title = $request->POST['title'];
        $content = $request->POST['content'];

        $journal = new Journal($id,$title,$content);
        $repo = new JournalRepository($this->database);
        $success = $repo->update($journal);
        if ($success) {
            echo 'success: ' . $repo->lastInsertId;
            $this->setRedirect('/journal/'.$repo->lastInsertId);
        } else {
            echo 'fail: ';
            return $this->formAction($request,$journal);
        }
    }
}