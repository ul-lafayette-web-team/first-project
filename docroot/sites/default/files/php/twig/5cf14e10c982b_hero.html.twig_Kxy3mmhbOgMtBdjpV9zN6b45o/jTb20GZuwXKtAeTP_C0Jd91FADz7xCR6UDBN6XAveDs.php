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

/* themes/oho_base/templates/other/hero.html.twig */
class __TwigTemplate_7ed97abc955b4068348ee824080970b4ad9fa943714b9ac65ae694bdffc5992b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 2];
        $filters = ["escape" => 1];
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
        echo "<section class=\"hero section--global-spacing ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["hero_classes"] ?? null)), "html", null, true);
        echo "\">
  ";
        // line 2
        if ((($context["media_type"] ?? null) != "none")) {
            // line 3
            echo "    <div class=\"hero__media\">
      ";
            // line 4
            if ((($context["media_type"] ?? null) == "video")) {
                // line 5
                echo "        ";
                if ((($context["video_type"] ?? null) == "video")) {
                    // line 6
                    echo "          <div class=\"video-feature\">
            <video id=\"hero\" loop muted poster=\"";
                    // line 7
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["video_poster"] ?? null)), "html", null, true);
                    echo "\">
              <source src=\"";
                    // line 8
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["video"] ?? null)), "html", null, true);
                    echo "\">
            </video>
          </div>
        ";
                } elseif ((                // line 11
($context["video_type"] ?? null) == "iframe")) {
                    // line 12
                    echo "          <div class=\"video-feature\">
            <iframe width=\"560\" height=\"315\" src=\"";
                    // line 13
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["video"] ?? null)), "html", null, true);
                    echo "\" frameborder=\"0\" allow=\"autoplay; encrypted-media; loop\" allowfullscreen></iframe>
          </div>
        ";
                } elseif ((                // line 15
($context["video_type"] ?? null) == "yt_player")) {
                    // line 16
                    echo "          <div class=\"video-feature\">
            <div id=\"bgndVideo\" class=\"player\" data-property=\"{videoURL:'";
                    // line 17
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["video"] ?? null)), "html", null, true);
                    echo "',containment:'body',autoPlay:true, showControls:false, mute:true, startAt:0, opacity:1, loop:true, anchor:'center,center', useOnMobile:false, mobileFallbackImage:'";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["video_poster"] ?? null)), "html", null, true);
                    echo ", optimizeDisplay:true'}\"></div>
          </div>
        ";
                }
                // line 20
                echo "      ";
            }
            // line 21
            echo "
      ";
            // line 22
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["image"] ?? null)), "html", null, true);
            echo "
    </div>
    ";
            // line 24
            if (($context["overlay"] ?? null)) {
                // line 25
                echo "      <div class=\"hero__overlay\" aria-hidden=\"true\"></div>
    ";
            }
            // line 27
            echo "  ";
        }
        // line 28
        echo "  <div class=\"hero__content\">
    <h1>";
        // line 29
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
        echo "</h1>
    ";
        // line 30
        if (($context["subtitle"] ?? null)) {
            // line 31
            echo "      <p>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["subtitle"] ?? null)), "html", null, true);
            echo "</p>
    ";
        }
        // line 33
        echo "    ";
        if (($context["description"] ?? null)) {
            // line 34
            echo "      ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["description"] ?? null)), "html", null, true);
            echo "
    ";
        }
        // line 36
        echo "    ";
        if (($context["link"] ?? null)) {
            // line 37
            echo "      ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["link"] ?? null)), "html", null, true);
            echo "
    ";
        }
        // line 39
        echo "  </div>
</section>
";
    }

    public function getTemplateName()
    {
        return "themes/oho_base/templates/other/hero.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  159 => 39,  153 => 37,  150 => 36,  144 => 34,  141 => 33,  135 => 31,  133 => 30,  129 => 29,  126 => 28,  123 => 27,  119 => 25,  117 => 24,  112 => 22,  109 => 21,  106 => 20,  98 => 17,  95 => 16,  93 => 15,  88 => 13,  85 => 12,  83 => 11,  77 => 8,  73 => 7,  70 => 6,  67 => 5,  65 => 4,  62 => 3,  60 => 2,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/oho_base/templates/other/hero.html.twig", "/vol/web/lafayette/docroot/themes/oho_base/templates/other/hero.html.twig");
    }
}
