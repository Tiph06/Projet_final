<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $centres = [
            ['name' => 'Centre Parisien Spécialisé',      'coords' => [48.8566, 2.3522]],
            ['name' => 'Centre Marseille Spécialisé',     'coords' => [43.2965, 5.3698]],
            ['name' => 'Centre Nice Spécialisé',          'coords' => [43.7102, 7.2620]],
            ['name' => 'Centre Lyon Spécialisé',          'coords' => [45.7640, 4.8357]],
            ['name' => 'Centre Toulouse Spécialisé',      'coords' => [43.6047, 1.4442]],
            ['name' => 'Centre Bordeaux Spécialisé',      'coords' => [44.8378, -0.5792]],
            ['name' => 'Centre Lille Spécialisé',         'coords' => [50.6292, 3.0573]],
            ['name' => 'Centre Nantes Spécialisé',        'coords' => [47.2184, -1.5536]],
            ['name' => 'Centre Strasbourg Spécialisé',    'coords' => [48.5734, 7.7521]],
            ['name' => 'Centre Montpellier Spécialisé',   'coords' => [43.6108, 3.8767]],
            ['name' => 'Centre Rennes Spécialisé',        'coords' => [48.1173, -1.6778]],
            ['name' => 'Centre Grenoble Spécialisé',      'coords' => [45.1885, 5.7245]],
            ['name' => 'Centre Clermont-Ferrand Spéc.',   'coords' => [45.7772, 3.0870]],
            ['name' => 'Centre Dijon Spécialisé',         'coords' => [47.3220, 5.0415]],
            ['name' => 'Centre Angers Spécialisé',        'coords' => [47.4784, -0.5632]],
            ['name' => 'Centre Tours Spécialisé',         'coords' => [47.3941, 0.6848]],
            ['name' => 'Centre Toulon Spécialisé',        'coords' => [43.1242, 5.9280]],
            ['name' => 'Centre Nîmes Spécialisé',         'coords' => [43.8367, 4.3601]],
            ['name' => 'Centre Avignon Spécialisé',       'coords' => [43.9493, 4.8055]],
            ['name' => 'Centre Nancy Spécialisé',         'coords' => [48.6921, 6.1844]],
            ['name' => 'Centre Metz Spécialisé',          'coords' => [49.1193, 6.1757]],
            ['name' => 'Centre Besançon Spécialisé',      'coords' => [47.2378, 6.0241]],
            ['name' => 'Centre Poitiers Spécialisé',      'coords' => [46.5802, 0.3404]],
            ['name' => 'Centre Caen Spécialisé',          'coords' => [49.1829, -0.3707]],
            ['name' => 'Centre Rouen Spécialisé',         'coords' => [49.4431, 1.0993]],
            ['name' => 'Centre Orléans Spécialisé',       'coords' => [47.9038, 1.9093]],
            ['name' => 'Centre Reims Spécialisé',         'coords' => [49.2583, 4.0317]],
            ['name' => 'Centre Saint-Étienne Spécialisé', 'coords' => [45.4397, 4.3872]],
            ['name' => 'Centre Aix-en-Provence Spéc.',    'coords' => [43.5297, 5.4474]],
        ];


        return view('blog.index', compact('centres'));
    }
}
