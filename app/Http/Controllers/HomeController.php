<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Get featured projects
            $featuredProjects = Project::with(['user', 'category'])
                ->where('is_featured', true)
                ->where('status', 'open')
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();

            // Get recent projects
            $recentProjects = Project::with(['user', 'category'])
                ->where('status', 'open')
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();

            // Get top freelancers
            $topFreelancers = User::where('user_type', 'freelancer')
                ->orderBy('rating', 'desc')
                ->orderBy('total_reviews', 'desc')
                ->take(8)
                ->get();

            // Get recent community posts with user and category relationships
            $recentPosts = Post::with(['user', 'category'])
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();

            // Get categories with post counts
            $categories = Category::withCount('posts')
                ->orderBy('name')
                ->get();

            // Get platform statistics
            $stats = [
                'total_projects' => Project::count(),
                'total_freelancers' => User::where('user_type', 'freelancer')->count(),
                'total_completed' => Project::where('status', 'completed')->count(),
                'total_earnings' => Project::where('status', 'completed')->sum('budget_max'),
            ];

            return view('welcome', compact(
                'featuredProjects',
                'recentProjects', 
                'topFreelancers',
                'recentPosts',
                'categories',
                'stats'
            ));
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Home page error: ' . $e->getMessage());
            
            // Return view with empty data
            return view('welcome', [
                'featuredProjects' => collect(),
                'recentProjects' => collect(),
                'topFreelancers' => collect(),
                'recentPosts' => collect(),
                'categories' => collect(),
                'stats' => [
                    'total_projects' => 0,
                    'total_freelancers' => 0,
                    'total_completed' => 0,
                    'total_earnings' => 0,
                ]
            ]);
        }
    }
}