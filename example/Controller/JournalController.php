<?php

namespace Controller;

use Fredy\Controller\Controller;
use Fredy\View\BootstrapHTMLGenerator;
use Fredy\View\HTMLResponse;
use Fredy\View\RedirectResponse;
use Model\Entity\Journal;
use Model\Repository\JournalRepository;
use View\FrontendResponse;

class JournalController extends Controller {

    /**
     * @var \PDO
     */
    private $database;

    private $languageLoader;

    /**
     * @param \PDO $database
     * @param \Fredy\LanguageLoader $languageLoader
     */
    public function __construct($database, $languageLoader)
    {
        $this->database = $database;
        $this->languageLoader = $languageLoader;
    }

    /**
     * [indexAction description]
     *
     * @param  \Fredy\Model\Entity\Request $request
     *
     * @return array    TwigContext
     */
    function indexAction($request)
    {

        $response = new FrontendResponse('journal/journalList.twig', $request);

        $journalRepository = new JournalRepository($this->database);

        $journals = $journalRepository->findAll();

        $journals = array_reverse($journals);

        $response->setTwigVariables(
            [
                'journals' => $journals

            ]
        );

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

        $response->setTwigVariables(
            [
                'journal' => $journal,


            ]
        );

        return $response;
    }

    public function formAction($request, $entity = null)
    {
        $response = new FrontendResponse('journal/journalForm.twig', $request);

        $languageContainer = $this->languageLoader->loadLanguageFile('journal');

        $bootstrapHTMLGenerator = new BootstrapHTMLGenerator();

        $form = $bootstrapHTMLGenerator->getForm('journal', '');

        $buttonText = 'Save';
        if ($entity != null && $entity['id'] != null) {
            $form->addChildren($bootstrapHTMLGenerator->getHidden('id', $entity['id']));
        }

        if ($entity != null) {
            $title = $entity['title'];

            $content = $entity['content'];
            if ($content->valid || ($content->valid === null)) {
                $contentHelpText = null;
                $contentHasError = false;
            } else {
                $contentHelpText = $languageContainer->getStringWithAttributes(
                    'content_too_short',
                    [
                        $content->dataType->minLength
                    ]
                );
                $contentHasError = true;
            }
        } else {
            $contentHasError = $title = $content = $contentHelpText = null;
        }
        $form->addChildren(
            $bootstrapHTMLGenerator->getTextfield(
                'title', 'Title', $title, 'Title', null, true, false, ['autofocus' => true]
            )
        );

        $content = $entity != null ? $entity['content'] : null;
        $form->addChildren(
            $bootstrapHTMLGenerator->getTextarea(
                'content', 'Content', $content, 'Content', $contentHelpText, true, $contentHasError
            )
        );

        $form->addChildren($bootstrapHTMLGenerator->getButton('submit', null, $buttonText));

        $response->setTwigVariables(
            [
                'form' => $form->render(),


            ]
        );

        return $response;

    }

    public function editAction($request)
    {
        $journalRepository = new JournalRepository($this->database);

        $id = $request->matches['id'];
        $journal = $journalRepository->findById($id);

        return $this->formAction($request, $journal);
    }

    public function submitAction($request)
    {
        $id = array_key_exists('id', $request->POST) ? $request->POST['id'] : null;
        $title = $request->POST['title'];
        $content = $request->POST['content'];

        $journal = new Journal($id, $title, $content);
        $repo = new JournalRepository($this->database);
        $success = $repo->update($journal);
        if ($success) {
            $redirectId = $id == null ? $repo->lastInsertId : $id;

            return new RedirectResponse('/journal/' . $redirectId);
        } else {
            return $this->formAction($request, $journal);
        }
    }

    public function deleteAction($request)
    {
        $id = $request->matches['id'];

        $repo = new JournalRepository($this->database);

        $journalToRemove = $repo->findById($id);

        $success = $repo->remove($journalToRemove);

        return new RedirectResponse('/journal');
    }
}