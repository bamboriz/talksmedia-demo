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
        $validator->validate($jsonSellersJson, (object) ['$ref' => 'file://'.realpath(__DIR__.'/config.json')]);

        if ($validator->isValid()) {
            foreach ($associativeSellersJson['sellers'] as $seller) {
                $newSeller = new Seller();
                $newSeller->setSellerId((int) $seller['seller_id']);
                $newSeller->setType($seller['seller_type']);
                $newSeller->setIsConfidential($seller['is_confidential']);

                $this->entityManager->persist($newSeller);
            }

            $this->entityManager->flush();
            $this->sellers = $associativeSellersJson['sellers'];
        }
    }

    public function getSellers()
    {
        return $this->sellers;
    }
}