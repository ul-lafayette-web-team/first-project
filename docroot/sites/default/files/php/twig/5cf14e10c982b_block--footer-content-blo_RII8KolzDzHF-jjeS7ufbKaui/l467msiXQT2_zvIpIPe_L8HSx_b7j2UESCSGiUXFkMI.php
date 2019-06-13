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

/* themes/louisiana/templates/block/block--footer-content-block.html.twig */
class __TwigTemplate_cb9f203b4a6d71350312cb2c237e99aa77df84d0b0a1b43b2e3af8d3c69f58f3 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["import" => 1];
        $filters = ["escape" => 4, "t" => 14];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['import'],
                ['escape', 't'],
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
        // line 1
        $context["oho_macros"] = $this->loadTemplate("@oho_base/includes/oho-macros.html.twig", "themes/louisiana/templates/block/block--footer-content-block.html.twig", 1)->unwrap();
        // line 2
        echo "
<div class=\"cell initial-12 medium-auto initial-order-3 medium-order-2\">
  ";
        // line 4
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_fcb_phone_number", [])), "html", null, true);
        echo "
  ";
        // line 5
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_fcb_email", [])), "html", null, true);
        echo "

  <div class=\"site-footer__address\">
    ";
        // line 8
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_component_body", [])), "html", null, true);
        echo "
  </div>
</div>

<div class=\"cell initial-6 medium-3 initial-order-2 medium-order-3\">
  <div class=\"site-footer__social-media\">
    <h2 class=\"show-for-sr\">";
        // line 14
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Social Media Links"));
        echo "</h2>
    ";
        // line 15
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["oho_macros"]->getfield_list($this->getAttribute(($context["content"] ?? null), "field_fcb_social_media_links", []), "social-media"));
        echo "
  </div>
</div>

<div class=\"cell initial-12 initial-order-4\">
  <p class=\"site-footer__copyright\">© ";
        // line 20
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["copyright_year"] ?? null)), "html", null, true);
        echo " ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("College of the Universities. All rights reserved."));
        echo "</p>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/louisiana/templates/block/block--footer-content-block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 20,  84 => 15,  80 => 14,  71 => 8,  65 => 5,  61 => 4,  57 => 2,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/louisiana/templates/block/block--footer-content-block.html.twig", "/vol/web/lafayette/docroot/themes/louisiana/templates/block/block--footer-content-block.html.twig");
    }
}
