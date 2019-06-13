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

/* themes/oho_base/templates/other/eu_cookie_compliance_popup_info.html.twig */
class __TwigTemplate_65cf0e4c1a49f4f323065a60bfb5daf1cf0c18a0cebfbdd90695eadc265fbd49 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 12];
        $filters = ["escape" => 7];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
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
        // line 1
        echo "<article class=\"cookie-compliance-popup\">
  <div class=\"eu-cookie-compliance-banner eu-cookie-compliance-banner-info\">
    <div class =\"popup-content info eu-cookie-compliance-content\">
      <div id=\"popup-text\" class=\"eu-cookie-compliance-message\">
        <div class=\"row\">
          <div class=\"columns small-12 medium-7\">
            ";
        // line 7
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["message"] ?? null)), "html", null, true);
        echo "
          </div>
          <div class=\"columns small-12 medium-5\">
            <div id=\"popup-buttons\" class=\"eu-cookie-compliance-buttons\">
              <button type=\"button\" class=\"btn ";
        // line 11
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["primary_button_class"] ?? null)), "html", null, true);
        echo "\">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["agree_button"] ?? null)), "html", null, true);
        echo "</button>
              ";
        // line 12
        if (($context["disagree_button"] ?? null)) {
            // line 13
            echo "                <button type=\"button\" class=\"find-more-button eu-cookie-compliance-more-button\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["disagree_button"] ?? null)), "html", null, true);
            echo "</button>
              ";
        }
        // line 15
        echo "              ";
        if (($context["secondary_button_label"] ?? null)) {
            // line 16
            echo "                <button type=\"button\" class=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["secondary_button_class"] ?? null)), "html", null, true);
            echo "\" >";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["secondary_button_label"] ?? null)), "html", null, true);
            echo "</button>
              ";
        }
        // line 18
        echo "            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</article>
";
    }

    public function getTemplateName()
    {
        return "themes/oho_base/templates/other/eu_cookie_compliance_popup_info.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 18,  87 => 16,  84 => 15,  78 => 13,  76 => 12,  70 => 11,  63 => 7,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/oho_base/templates/other/eu_cookie_compliance_popup_info.html.twig", "/vol/web/lafayette/docroot/themes/oho_base/templates/other/eu_cookie_compliance_popup_info.html.twig");
    }
}
