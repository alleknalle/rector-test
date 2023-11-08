<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Throwable;
use Traversable;

final class FormTest extends AbstractType implements DataMapperInterface
{
    /**
     * @param array<string, mixed> $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'test',
                NumberType::class,
                [
                    'required' => true,
                    'empty_data' => null,
                    'constraints' => [
                        new NotBlank(),
                    ],
                    'scale' => 4,
                    'html5' => true,
                    'attr' => ['min' => '0', 'max' => '10', 'step' => '1'],
                ]
            )
            ->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'allow_extra_fields' => false,
                'empty_data' => null,
                'constraints' => [
                    new NotNull(),
                ],
            ]
        );
    }

    public function mapDataToForms(mixed $viewData, Traversable $forms): void
    {
        // there is no data yet, so nothing to prepopulate
        if ($viewData === null) {
            return;
        }

        /** @var FormInterface[] $form */
        $form = iterator_to_array($forms);

        $form['test']->setData($viewData);
    }

    public function mapFormsToData(Traversable $forms, mixed &$viewData): void
    {
        try {
            /** @var FormInterface[] $form */
            $form = iterator_to_array($forms);

            $test = $form['test']->getData();

            $viewData = [
                'test' => $test
            ];
        } catch (Throwable) {
            // do nothing
        }
    }
}
