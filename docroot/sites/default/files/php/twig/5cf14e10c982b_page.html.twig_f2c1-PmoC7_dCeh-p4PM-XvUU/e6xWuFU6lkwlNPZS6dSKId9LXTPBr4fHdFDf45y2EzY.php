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

/* themes/louisiana/templates/system/page.html.twig */
class __TwigTemplate_db80eac3103e5803ef6acd46694f80afd6ce8f2445a06fc10c8c209f0a0c459b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 2, "if" => 23];
        $filters = ["escape" => 19, "join" => 21, "merge" => 21, "t" => 38];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape', 'join', 'merge', 't'],
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
        // line 2
        $context["page_classes"] = [0 => "page"];
        // line 6
        echo "
";
        // line 8
        $context["wrapper_classes"] = [0 => "page-wrapper"];
        // line 12
        echo "
";
        // line 14
        $context["content_classes"] = [0 => "main-content"];
        // line 18
        echo "
";
        // line 19
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["alert_message"] ?? null)), "html", null, true);
        echo "

<div class=\"";
        // line 21
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_join_filter(twig_array_merge($this->sandbox->ensureToStringAllowed(($context["page_classes"] ?? null)), $this->sandbox->ensureToStringAllowed(($context["preprocess_page_classes"] ?? null))), " "), "html", null, true);
        echo "\">

  ";
        // line 23
        if ($this->getAttribute(($context["page"] ?? null), "highlighted", [])) {
            // line 24
            echo "    <div class=\"system-region\">
      <div class=\"grid-container\">
        <div class=\"system-messages\">
          ";
            // line 27
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted", [])), "html", null, true);
            echo "
        </div>
      </div>
    </div>
  ";
        }
        // line 32
        echo "
  <header class=\"site-header\">
    <div class=\"grid-container\">
      <a class=\"site-header__logo\" href=\"/\">
        <img width=\"191\" height=\"175\" src=\"";
        // line 36
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)) . $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null))), "html", null, true);
        echo "/assets/img/ULL-logo-inverse.svg\" alt=\"OHO Logo\">
      </a>
      <button class=\"mobile-menu-button\" data-button-open-text=\"";
        // line 38
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Open the main menu"));
        echo "\" data-button-close-text=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Close the main menu"));
        echo "\" data-button-enable-at=\"0\" data-button-disable-at=\"1024\" data-button-open-class=\"mobile-menu-open\">
        <span class=\"show-for-sr\"></span>
      </button>
      <div class=\"site-header__main\">
        <div class=\"site-header__top\">
          ";
        // line 43
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "secondary_nav", [])), "html", null, true);
        echo "
        </div>
        <div class=\"site-header__bottom\">
          ";
        // line 46
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "primary_nav", [])), "html", null, true);
        echo "
        </div>
      </div>
    </div>
  </header>

  <div class=\"";
        // line 52
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_join_filter(twig_array_merge($this->sandbox->ensureToStringAllowed(($context["wrapper_classes"] ?? null)), $this->sandbox->ensureToStringAllowed(($context["preprocess_wrapper_classes"] ?? null))), " "), "html", null, true);
        echo "\">
    <main id=\"main-content\" class=\"";
        // line 53
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_join_filter(twig_array_merge($this->sandbox->ensureToStringAllowed(($context["content_classes"] ?? null)), $this->sandbox->ensureToStringAllowed(($context["preprocess_content_classes"] ?? null))), " "), "html", null, true);
        echo "\">
      ";
        // line 54
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])) {
            // line 55
            echo "        <div class=\"cell medium-3\">
          ";
            // line 56
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])), "html", null, true);
            echo "
        </div>
      ";
        } else {
            // line 59
            echo "        <div class=\"cell medium-auto\">
          ";
            // line 60
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "title", [])), "html", null, true);
            echo "
          ";
            // line 61
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
            echo "
        </div>
      ";
        }
        // line 64
        echo "    </main>
  </div>

  ";
        // line 67
        if ($this->getAttribute(($context["page"] ?? null), "footer_upper", [])) {
            // line 68
            echo "    <section class=\"sock\">
      <div class=\"grid-container\">
        ";
            // line 70
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_upper", [])), "html", null, true);
            echo "
      </div>
    </section>
  ";
        }
        // line 74
        echo "
  <footer class=\"site-footer\">
    <div class=\"grid-container\">
      <div class=\"grid-x grid-margin-x\">
        <div class=\"cell initial-6 medium-3 initial-order-1\">
          <a class=\"site-footer__logo\" href=\"/\">
            <img width=\"191\" height=\"175\" src=\"";
        // line 80
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)) . $this->sandbox->ensureToStringAllowed(($context["directory"] ?? null))), "html", null, true);
        echo "/assets/img/ULL-logo-inverse.svg\" alt=\"OHO Logo\">
          </a>
        </div>

        ";
        // line 84
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_lower", [])), "html", null, true);
        echo "
      </div>
    </div>
  </footer>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/louisiana/templates/system/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  196 => 84,  189 => 80,  181 => 74,  174 => 70,  170 => 68,  168 => 67,  163 => 64,  157 => 61,  153 => 60,  150 => 59,  144 => 56,  141 => 55,  139 => 54,  135 => 53,  131 => 52,  122 => 46,  116 => 43,  106 => 38,  101 => 36,  95 => 32,  87 => 27,  82 => 24,  80 => 23,  75 => 21,  70 => 19,  67 => 18,  65 => 14,  62 => 12,  60 => 8,  57 => 6,  55 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/louisiana/templates/system/page.html.twig", "/vol/web/lafayette/docroot/themes/louisiana/templates/system/page.html.twig");
    }
}
