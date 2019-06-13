<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/oho_base/templates/block/block--menu-block--utility-menu--region-secondary-nav.html.twig */
class __TwigTemplate_cac58775ab4bf5e4fe9163dd1a838eebe0acf4eeaa21729b2cf5b688481f132a extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["block" => 7];
        $filters = ["escape" => 8];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['block'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 6
        echo "<nav id=\"utility-menu\" class=\"utility-menu accessible-menu\" data-item-open-text=\"Open the %s menu\" data-item-close-text=\"Close the %s menu\">
  ";
        // line 7
        $this->displayBlock('content', $context, $blocks);
        // line 10
        echo "</nav>
";
    }

    // line 7
    public function block_content($context, array $blocks = [])
    {
        // line 8
        echo "    ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null)), "html", null, true);
        echo "
  ";
    }

    public function getTemplateName()
    {
        return "themes/oho_base/templates/block/block--menu-block--utility-menu--region-secondary-nav.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  69 => 8,  66 => 7,  61 => 10,  59 => 7,  56 => 6,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/oho_base/templates/block/block--menu-block--utility-menu--region-secondary-nav.html.twig", "/vol/web/lafayette/docroot/themes/oho_base/templates/block/block--menu-block--utility-menu--region-secondary-nav.html.twig");
    }
}
