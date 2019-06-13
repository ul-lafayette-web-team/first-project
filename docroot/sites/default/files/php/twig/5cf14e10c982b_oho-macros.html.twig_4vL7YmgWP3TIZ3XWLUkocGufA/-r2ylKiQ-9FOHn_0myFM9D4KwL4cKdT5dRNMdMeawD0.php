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

/* @oho_base/includes/oho-macros.html.twig */
class __TwigTemplate_d300f647e1c21de7a5b0c819638b6d15184b6cce35d09161b805ad966f7e96cb extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["macro" => 19, "if" => 20, "for" => 22, "import" => 31, "set" => 38];
        $filters = ["escape" => 21, "field_value" => 32, "merge" => 41];
        $functions = ["link" => 87];

        try {
            $this->sandbox->checkSecurity(
                ['macro', 'if', 'for', 'import', 'set'],
                ['escape', 'field_value', 'merge'],
                ['link']
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
        // line 16
        echo "
";
        // line 28
        echo "
";
        // line 34
        echo "
";
        // line 46
        echo "
";
        // line 54
        echo "
";
        // line 60
        echo "
";
        // line 70
        echo "
";
        // line 84
        echo "
";
    }

    // line 19
    public function getlist($__list_array__ = null, $__list_classes__ = null, $__list_item_classes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "list_array" => $__list_array__,
            "list_classes" => $__list_classes__,
            "list_item_classes" => $__list_item_classes__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 20
            echo "  ";
            if (($context["list_array"] ?? null)) {
                // line 21
                echo "    <ul";
                if (($context["list_classes"] ?? null)) {
                    echo " class=\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["list_classes"] ?? null)), "html", null, true);
                    echo "\"";
                }
                echo ">
      ";
                // line 22
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["list_array"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["list_item"]) {
                    // line 23
                    echo "        <li";
                    if (($context["list_item_classes"] ?? null)) {
                        echo " class=\"";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["list_item_classes"] ?? null)), "html", null, true);
                        echo "\"";
                    }
                    echo ">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["list_item"]), "html", null, true);
                    echo "</li>
      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['list_item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 25
                echo "    </ul>
  ";
            }
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 30
    public function getfield_list($__field__ = null, $__list_classes__ = null, $__list_item_classes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "field" => $__field__,
            "list_classes" => $__list_classes__,
            "list_item_classes" => $__list_item_classes__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 31
            echo "  ";
            $context["oho_macros"] = $this;
            // line 32
            echo "  ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["oho_macros"]->getlist($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed(($context["field"] ?? null))), ($context["list_classes"] ?? null), ($context["list_item_classes"] ?? null)));
            echo "
";
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 36
    public function getfield_list_multiple($__fields__ = null, $__list_classes__ = null, $__list_item_classes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "fields" => $__fields__,
            "list_classes" => $__list_classes__,
            "list_item_classes" => $__list_item_classes__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 37
            echo "  ";
            $context["oho_macros"] = $this;
            // line 38
            echo "  ";
            $context["list_array"] = [];
            // line 39
            echo "  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["fields"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                // line 40
                echo "    ";
                if ($this->getAttribute($context["field"], 0, [], "array", true, true)) {
                    // line 41
                    echo "      ";
                    $context["list_array"] = twig_array_merge($this->sandbox->ensureToStringAllowed(($context["list_array"] ?? null)), $this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed($context["field"])));
                    // line 42
                    echo "    ";
                }
                // line 43
                echo "  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 44
            echo "  ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["oho_macros"]->getlist(($context["list_array"] ?? null), ($context["list_classes"] ?? null), ($context["list_item_classes"] ?? null)));
            echo "
";
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 49
    public function getwrap_items($__items_array__ = null, $__wrap_tag__ = null, $__wrap_classes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "items_array" => $__items_array__,
            "wrap_tag" => $__wrap_tag__,
            "wrap_classes" => $__wrap_classes__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 50
            echo "  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items_array"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 51
                echo "    <";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["wrap_tag"] ?? null)), "html", null, true);
                if (($context["wrap_classes"] ?? null)) {
                    echo " class=\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["wrap_classes"] ?? null)), "html", null, true);
                    echo "\"";
                }
                echo ">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["item"]), "html", null, true);
                echo "</";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["wrap_tag"] ?? null)), "html", null, true);
                echo ">
  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 56
    public function getfield_wrapper($__field__ = null, $__wrap_tag__ = null, $__wrap_classes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "field" => $__field__,
            "wrap_tag" => $__wrap_tag__,
            "wrap_classes" => $__wrap_classes__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 57
            echo "  ";
            $context["oho_macros"] = $this;
            // line 58
            echo "  ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["oho_macros"]->getwrap_items($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue($this->sandbox->ensureToStringAllowed(($context["field"] ?? null))), ($context["wrap_tag"] ?? null), ($context["wrap_classes"] ?? null)));
            echo "
";
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 62
    public function getlink_field_link($__link_field__ = null, $__link_classes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "link_field" => $__link_field__,
            "link_classes" => $__link_classes__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 63
            echo "  ";
            if ($this->getAttribute(($context["link_field"] ?? null), 0, [], "array", true, true)) {
                // line 64
                echo "    ";
                $context["oho_macros"] = $this;
                // line 65
                echo "    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue(($context["link_field"] ?? null)));
                foreach ($context['_seq'] as $context["_key"] => $context["link_item"]) {
                    // line 66
                    echo "      ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["oho_macros"]->get_link_field_item_link($context["link_item"], ($context["link_classes"] ?? null)));
                    echo "
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link_item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 68
                echo "  ";
            }
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 72
    public function getlink_field_list($__link_field__ = null, $__list_classes__ = null, $__list_item_classes__ = null, $__link_classes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "link_field" => $__link_field__,
            "list_classes" => $__list_classes__,
            "list_item_classes" => $__list_item_classes__,
            "link_classes" => $__link_classes__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 73
            echo "  ";
            if ($this->getAttribute(($context["link_field"] ?? null), 0, [], "array", true, true)) {
                // line 74
                echo "    ";
                $context["oho_macros"] = $this;
                // line 75
                echo "    <ul";
                if (($context["list_classes"] ?? null)) {
                    echo " class=\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["list_classes"] ?? null)), "html", null, true);
                    echo "\"";
                }
                echo ">
      ";
                // line 76
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->env->getExtension('Drupal\twig_field_value\Twig\Extension\FieldValueExtension')->getFieldValue(($context["link_field"] ?? null)));
                foreach ($context['_seq'] as $context["_key"] => $context["link_item"]) {
                    // line 77
                    echo "        <li";
                    if (($context["list_item_classes"] ?? null)) {
                        echo " class=\"";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["list_item_classes"] ?? null)), "html", null, true);
                        echo "\"";
                    }
                    echo ">
          ";
                    // line 78
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["oho_macros"]->get_link_field_item_link($context["link_item"], ($context["link_classes"] ?? null)));
                    echo "
        </li>
      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link_item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 81
                echo "    </ul>
  ";
            }
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    // line 86
    public function get_link_field_item_link($__link_item__ = null, $__link_classes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "link_item" => $__link_item__,
            "link_classes" => $__link_classes__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 87
            echo "  ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getLink($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["link_item"] ?? null), "#title", [], "array")), $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["link_item"] ?? null), "#url", [], "array")), ["class" => [0 => ($context["link_classes"] ?? null)]]), "html", null, true);
            echo "
";
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "@oho_base/includes/oho-macros.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  452 => 87,  439 => 86,  422 => 81,  413 => 78,  404 => 77,  400 => 76,  391 => 75,  388 => 74,  385 => 73,  370 => 72,  354 => 68,  345 => 66,  340 => 65,  337 => 64,  334 => 63,  321 => 62,  303 => 58,  300 => 57,  286 => 56,  255 => 51,  250 => 50,  236 => 49,  218 => 44,  212 => 43,  209 => 42,  206 => 41,  203 => 40,  198 => 39,  195 => 38,  192 => 37,  178 => 36,  160 => 32,  157 => 31,  143 => 30,  126 => 25,  111 => 23,  107 => 22,  98 => 21,  95 => 20,  81 => 19,  76 => 84,  73 => 70,  70 => 60,  67 => 54,  64 => 46,  61 => 34,  58 => 28,  55 => 16,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@oho_base/includes/oho-macros.html.twig", "/vol/web/lafayette/docroot/themes/oho_base/templates/includes/oho-macros.html.twig");
    }
}
