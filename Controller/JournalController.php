<?php

namespace Controller;

use View\HTMLResponse;
use View\RedirectResponse;

use View\BootstrapHTMLGenerator;

use Model\Repository\Filter;
use Model\Repository\Condition;

use Model\Repository\JournalRepository;
use Model\Factory\JournalFactory;
use Model\Entity\Journal;

class JournalController extends Controller
{

    /**
     * @var \PDO
     */
    private $database;

    private $languageLoader;

    /**
     * @param \PDO $database
     * @param \Framework\LanguageLoader $languageLoader
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

        $response = new HTMLResponse('journal/journalList.twig');

        $journalRepository = new JournalRepository($this->database);

        $journals = $journalRepository->findAll();

        $response->setTwigVariables([
            'journals' => $journals
            ]);

        return $response;



        // $insertJournal = new \Model\Entity\Journal(NULL,'title','content');
        // $journalRepository->update($insertJournal);


        // $journal = $journalRepository->findById(1);
        // $journalRepository->remove($journal);

        // $filter = new Filter($this->database);
        // $filter->addCondition(new Condition('content','<>','content'));
        // $journals = $journalRepository->findByFilter($filter);

    }

    public function journalAction($request)
    {
        $response = new HTMLResponse('journal/journal.twig');

        $journalRepository = new JournalRepository($this->database);

        $id = $request->matches['id'];
        $journal = $journalRepository->findById($id);

        $response->setTwigVariables([
            'journal' => $journal
            ]);

        return $response;
    }

    public function formAction($request, $entity = NULL)
    {
        $response = new HTMLResponse('journal/journalForm.twig');

        $languageContainer = $this->languageLoader->loadLanguageFile('journal');

        $bootstrapHTMLGenerator = new BootstrapHTMLGenerator();

        $form = $bootstrapHTMLGenerator->getForm('journal','');

        $buttonText = 'Save';
        if ($entity!=NULL && $entity['id']!=NULL ) {
            $form->addChildren($bootstrapHTMLGenerator->getHidden('id',$entity['id']));
        }

        if ($entity!=NULL) {
            $title = $entity['title'];

            $content = $entity['content'];
            if ($content->valid||($content->valid===NULL)) {
                $contentHelpText = null;
                $contentHasError = false;
            } else {
                $contentHelpText = 
                    $languageContainer->getStringWithAttributes(
                        'content_too_short',
                        [
                            $content->dataType->minLength
                        ]);
                $contentHasError = true;
            }
        } else {
            $title = $content = $contentHelpText = NULL;
        }
        $form->addChildren($bootstrapHTMLGenerator->getTextfield('title','Title',$title,'Title',NULL,true,false,['autofocus'=>true]));

        $content = $entity!=NULL ? $entity['content'] : NULL;
        $form->addChildren($bootstrapHTMLGenerator->getTextarea('content','Content',$content,'Content',$contentHelpText,true, $contentHasError));

        $form->addChildren($bootstrapHTMLGenerator->getButton('submit',NULL,$buttonText));

        $response->setTwigVariables(['form' => $form->render()]);

        return $response;

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
            return new RedirectResponse('/journal/' . $redirectId);
        } else {
            return $this->formAction($request,$journal);
        }
    }
}