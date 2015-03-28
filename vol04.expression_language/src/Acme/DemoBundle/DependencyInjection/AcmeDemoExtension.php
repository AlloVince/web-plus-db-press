<?php
namespace Acme\DemoBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\GraphvizDumper;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\SerializedParsedExpression;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

use Acme\DemoBundle\Domain\BusinessHour;

class AcmeDemoExtension extends Extension
{
    /**
     * @var ExpressionLanguage
     */
    private $expressionLanguage;

    public function getAlias()
    {
        return 'acme_demo';
    }

    public function __construct()
    {
        $this->expressionLanguage = new ExpressionLanguage();
    }

    public function load(
        array $configs,
        ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container,
            new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $configuration = $this->getConfiguration(
            $configs, $container);
        $config = $this->processConfiguration(
            $configuration, $configs);

        $this->configureBusinessHourService($config, $container);

        $dumper = new GraphvizDumper($container);
        file_put_contents('container.dot', $dumper->dump());
    }

    private function configureBusinessHourService(
        $config,
        ContainerBuilder $container
    ) {
        foreach ($config['business_hours'] as $key => $value) {
            $spanService = $this->createExpression(
                $container,
                $value['span']
            );

            $id = 'acme_demo.business_hour.' . sha1($key);
            $container->register($id, BusinessHour::class)
                ->setPublic(true)
                ->addArgument($key)
                ->addArgument($spanService);

            $container->getDefinition(
                    'acme_demo.service.business_hour'
                )
                ->addMethodCall('add', [new Reference($id)]);
        }
    }

    private function createExpression($container, $expression)
    {
        $id = 'acme_demo.expression.' . sha1($expression);
        $container
            ->register($id, SerializedParsedExpression::class)
            ->setPublic(true)
            ->addArgument($expression)
            ->addArgument(
                serialize(
                    $this->getExpressionLanguage()->parse(
                        $expression, array('time'))->getNodes()
                )
            );

        return new Reference($id);
    }

    private function getExpressionLanguage()
    {
        return new ExpressionLanguage();
    }
}