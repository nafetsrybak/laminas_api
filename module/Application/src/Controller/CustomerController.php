<?php
namespace Application\Controller;

use Laminas\View\Model\JsonModel;
use Laminas\Form\Annotation\AnnotationBuilder;
use Application\Controller\Base\BaseRestfulController;

use Application\Form\CustomerForm;
use Application\Manager\CustomerManager;
use Application\DTO\Customer\{
    Customer,
    CustomerList
};
use Application\Resource\Customer\CustomerResource;

class CustomerController extends BaseRestfulController
{
    protected $customerManager;

    protected $customerForm;

    protected $customerResource;

    protected $formBuilder;

    public function __construct(
        CustomerManager $customerManager,
        CustomerForm $customerForm,
        CustomerResource $customerResource,
        AnnotationBuilder $formBuilder
    )
    {
        $this->customerManager = $customerManager;
        $this->customerForm = $customerForm;
        $this->customerResource = $customerResource;
        $this->formBuilder = $formBuilder;
    }

    /**
     * Create a new resource
     *
     * @param  mixed $data
     * @return JsonModel
     */
    public function create($data)
    {
        $response = $this->getResponse();
        $json = new JsonModel;
        $this->customerForm->setData($data);

        if ($this->customerForm->isValid()) {
            /** @var Customer $data */
            $data = $this->customerForm->getData();

            $customer = $this->customerManager->createCustomer($data);

            $resource = $this->customerResource->getCreateResource($customer);
            $response->setStatusCode(200);
            $json->setVariables($resource);
            return $json;
        }

        $response->setStatusCode(422);
        $json->setVariables([
            'messages' => $this->customerForm->getMessages()
        ]);

        return $json;
    }

    public function getList()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
        $data = $request->getQuery();
        $json = new JsonModel;

        $form = $this->formBuilder->createForm(CustomerList::class);
        $form->setData($data);
        if ($form->isValid()) {
            $data = $form->getData();

            $customerList = $this->customerManager->getCustomerList($data);

            $resource = $this->customerResource->getListResource($customerList);
            $response->setStatusCode(200);
            $json->setVariables($resource);
            return $json;
        }

        $response->setStatusCode(422);
        $json->setVariables([
            'messages' => $form->getMessages()
        ]);

        return $json;
    }
}
