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

    /**
     * @var \PDO
     */
    private $database;

    private $languageLoader;

    /**
     * @param \PDO $database
     */
    public function __construct($database,$languageLoader)
    {
        $this->database = $database;
        $this->languageLoader = $languageLoader;
    }

    /**
     * [indexAction description]
     * @param  \Model\Entity\Request $request
     * @return array    TwigContext
     */
    function indexAction($request)
    {

        $this->loadTemplate('journal/journalList.twig');

        $journalRepository = new JournalRepository($this->database);

        // $insertJournal = new \Model\Entity\Journal(NULL,'title','content');
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

    public function formAction($request, $entity = NULL)
    {
        $this->loadTemplate('journal/journalForm.twig');

        $languageContainer = $this->languageLoader->loadLanguageFile('journal');

        $bootstrapHTMLGenerator = new BootstrapHTMLGenerator();

        $form = $bootstrapHTMLGenerator->getForm('journal','');

        $buttonText = 'Send';
        if ($entity!=NULL && $entity['id']!=NULL ) {
            $form->addChildren($bootstrapHTMLGenerator->getHidden('id',$entity['id']));
            $buttonText = 'Update';
        }

        if ($entity!=NULL) {
            $title = $entity['title'];

            $content = $entity['content'];
            $contentHelpText = $content->valid||$content->valid==NULL ? 
                NULL :
                $languageContainer->getStringWithAttributes(
                    'content_too_short',
                    [
                        $content->dataType->minLength
                    ]);
        } else {
            $title = $content = $contentHelpText = NULL;
        }
        $form->addChildren($bootstrapHTMLGenerator->getTextfield('title','Title',$title,'Title',NULL,true,['autofocus'=>true]));

        $content = $entity!=NULL ? $entity['content'] : NULL;
        $form->addChildren($bootstrapHTMLGenerator->getTextarea('content','Content',$content,'Content',$contentHelpText,true));

        $form->addChildren($bootstrapHTMLGenerator->getButton('submit',NULL,$buttonText));

        $twigContext = array('form' => $form->render());

        return $twigContext;

    }

    public function editAction($request)
    {
        $journalRepository = new JournalRepository($this->database);

        $id = $request->matches['id'];
        $journal = $journalRepository->findById($id);

        return $this->formAction($request,$journal);
    }

    public function submitAction($request)
    {
        $id = array_key_exists('id', $request->POST) ? $request->POST['id']:NULL;
        $title = $request->POST['title'];
        $content = $request->POST['content'];

        $journal = new Journal($id,$title,$content);
        $repo = new JournalRepository($this->database);
        $success = $repo->update($journal);
        if ($success) {
            $redirectId = $id==NULL ? $repo->lastInsertId : $id;
            $this->setRedirect('/journal/'.$redirectId);
        } else {
            return $this->formAction($request,$journal);
        }
    }
}