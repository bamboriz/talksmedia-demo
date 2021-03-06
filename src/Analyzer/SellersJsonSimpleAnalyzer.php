<?php

declare(strict_types=1);

namespace App\Analyzer;

use App\Entity\Seller;
use Doctrine\ORM\EntityManagerInterface;
use JsonSchema\Validator;

/**
 * SellersJsonSimpleAnalyzer.
 */
class SellersJsonSimpleAnalyzer implements SellersJsonAnalyzerInterface
{
    private array $sellers = [];

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function analyze(array $associativeSellersJson): void
    {
        $jsonSellersJson = (object) $associativeSellersJson;
        $validator = new Validator();
        $validator->validate($jsonSellersJson, (object) ['$ref' => 'file://'.realpath(__DIR__.'/schema.json')]);

        if ($validator->isValid()) {
            foreach ($associativeSellersJson['sellers'] as $seller) {
                $newSeller = new Seller();
                $newSeller->setSellerId((int) $seller['seller_id']);
                $newSeller->setType($seller['seller_type']);
                $newSeller->setIsConfidential($seller['is_confidential'] ?? 0);
                $newSeller->setIsPassthrough($seller['is_passthrough'] ?? 0);
                $newSeller->setName($seller['name'] ?? '');
                $newSeller->setDomain($seller['domain'] ?? '');
                $newSeller->setComment($seller['comment'] ?? '');

                $this->entityManager->persist($newSeller);
            }

            $this->entityManager->flush();
            $this->sellers = $associativeSellersJson['sellers'];
        }
        else {
            echo "Violation(s):\n";
            foreach ($validator->getErrors() as $error) {
                printf("[%s] %s\n", $error['property'], $error['message']);
            }
            throw new \Exception('sellers.json not valid.');
        }
    }

    public function getSellers()
    {
        return $this->sellers;
    }
}