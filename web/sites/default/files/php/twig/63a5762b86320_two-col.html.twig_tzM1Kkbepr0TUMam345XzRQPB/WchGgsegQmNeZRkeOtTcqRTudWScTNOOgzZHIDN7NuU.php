<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/oyw_layouts/templates/two-col.html.twig */
class __TwigTemplate_70c6269f463ddfc80f45c6cbfd578b5793aff7df0a6f8e5a53c851d33c4f1694 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        if (($context["content"] ?? null)) {
            // line 2
            echo "  <div ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => "two-col"], "method", false, false, true, 2), 2, $this->source), "html", null, true);
            echo ">
  ";
            // line 3
            if (twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "main", [], "any", false, false, true, 3)) {
                // line 4
                echo "    <div ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["region_attributes"] ?? null), "main", [], "any", false, false, true, 4), "addClass", [0 => "main-region"], "method", false, false, true, 4), 4, $this->source), "html", null, true);
                echo ">
      ";
                // line 5
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "main", [], "any", false, false, true, 5), 5, $this->source), "html", null, true);
                echo "
    </div>
  ";
            }
            // line 8
            echo "  ";
            if (twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "sidebar", [], "any", false, false, true, 8)) {
                // line 9
                echo "    <div ";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["region_attributes"] ?? null), "sidebar", [], "any", false, false, true, 9), "addClass", [0 => "sidebar-region"], "method", false, false, true, 9), 9, $this->source), "html", null, true);
                echo ">
      ";
                // line 10
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content"] ?? null), "sidebar", [], "any", false, false, true, 10), 10, $this->source), "html", null, true);
                echo "
    </div>
  ";
            }
            // line 13
            echo "  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "modules/custom/oyw_layouts/templates/two-col.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 10,  62 => 9,  59 => 8,  53 => 5,  48 => 4,  46 => 3,  41 => 2,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/oyw_layouts/templates/two-col.html.twig", "/var/www/html/web/modules/custom/oyw_layouts/templates/two-col.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 1);
        static $filters = array("escape" => 2);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

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
}
