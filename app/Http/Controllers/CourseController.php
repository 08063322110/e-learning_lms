<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Repositories\CourseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Auth;
use DB;
use Response;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseUser;
 use App\Models\Item;


class CourseController extends AppBaseController
{
    /** @var  CourseRepository */
    private $courseRepository;

    public function __construct(CourseRepository $courseRepo)
    {
        $this->courseRepository = $courseRepo;
    }

    /**
     * Display a listing of the Course.
     *
     * @param Request $request
     *
     * @return Response
     */


    public function items ($course_id, $item_id){
        //Get the list of items that belongs to this Course.
        $course = $this->courseRepository->find($course_id);
        //Pass it to the Course/Contents View.

       if (empty($course)) {
        Flash::error('Course not found');
        return redirect()->back();
       }
       //Pass it to the course/contents view
        $item = Item::where('id', $item_id)->first();
        DB::table('items')->where('id', $item_id)->increment('view_count');

            $items = 'yes';

    return view('courses.show')
    ->with('course', $course)
    ->with('items', $items)
    ->with('item', $item);
    }

  public function subscribers($course_id)
{
    $course = Course::findOrFail($course_id);
    $courseUsers = $course->users; // this uses the relationship with 'course_users'
    return view('courses.subscribers', compact('course', 'courseUsers'));
}
        
   public function contents($course_id)
{
    $course = Course::findOrFail($course_id);
    
    // This is the line that was missing
    $items = Item::where('course_id', $course_id)->orderBy('id', 'asc')->get();

    return view('courses.contents', compact('course', 'items'));
}
        

    public function approve (Request $request){
        Course::where('id', $request->course_id)
        ->update([
            'admin_status'=>1
        ]);
        Flash::success('Course Approved Successfully.');
        return redirect()->back();
    }



    public function disapprove(Request $request) {
        Course::where('id', $request->course_id)
        ->update([
            'admin_status'=>0
        ]);
        Flash::success('Course Disapproved Successfully.');
        return redirect()->back();
    }

     public function publishCourse(Request $request) {
         Course::where('id', $request->course_id)
        ->update([
            'creator_status'=>1
        ]);
        Flash::success('Course Published Successfully.');
        return redirect()->back();

    }

       public function unpublishCourse(Request $request) {
    Course::where('id', $request->course_id)
        ->update([
            'creator_status'=>0
        ]);
        Flash::success('Course Unpublished Successfully.');
        return redirect()->back();
    }

    public function index(Request $request)
{
    if(Auth::user()->role_id == 4 && $request->has('my')){
        // STUDENT: Show only enrolled courses
        $courseIds = \App\Models\CourseUser::where('user_id', Auth::id())->pluck('course_id');
        $courses = Course::whereIn('id', $courseIds)->get();
    }else{
        // ADMIN/TEACHER/STUDENT BROWSE: Show all courses
        $courses = Course::all();
    }

    return view('courses.index')->with('courses', $courses);
}

    /**
     * Show the form for creating a new Course.
     *
     * @return Response
     */
    public function create()
    {
    $categories = Category::all();
        return view('courses.create')->with('categories', $categories);
    }

    /**
     * Store a newly created Course in storage.
     *
     * @param CreateCourseRequest $request
     *
     * @return Response
     */
    public function store(CreateCourseRequest $request)
    {
        $input = $request->all();
        $input['user_id'] =  Auth::user()->id;

        $input['view_count'] = 0;
        $input['subscriber_count'] = 0;
        $input['photo'] = '';

$course = $this->courseRepository->create($input);

        $course = $this->courseRepository->create($input);

        Flash::success('Course saved successfully.');

        return redirect(route('courses.index'));
    }

    /**
     * Display the specified Course.
     *
     * @param int $id
     *
     * @return Response
     */
   
public function show($id)
{
    $course = Course::with(['user', 'category'])->findOrFail($id);
    
    $getSubscription = null;
    if(Auth::check()){
        $getSubscription = CourseUser::where('user_id', Auth::id())
                            ->where('course_id', $course->id)
                            ->first();
    }

    $description = 'yes'; // ADD THIS LINE
    
    return view('courses.show', compact('course', 'getSubscription', 'description'));
}
    /**
     * Show the form for editing the specified Course.
     *
     * @param int $id
     *
     * @return Response
     */
  public function edit($id)
{
    $course = $this->courseRepository->find($id);

    if (empty($course)) {
        Flash::error('Course not found');
        return redirect(route('courses.index'));
    }

    return view('courses.edit')->with('course', $course); // MUST have this
}
public function update(Request $request, $id)
{
    $input = $request->all();
    
    // Don't overwrite photo if left empty
    if (empty($input['photo'])) {
        unset($input['photo']);
    }

    $course = $this->courseRepository->update($input, $id);
}

public function unsubscribe($course_id, $user_id)
{
    $course = Course::findOrFail($course_id);
    $course->users()->detach($user_id); // only removes from this course

    Flash::success('Subscriber removed successfully.');
    return redirect()->back();
}

    public function destroy($id)
    {
        $course = $this->courseRepository->find($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        $this->courseRepository->delete($id);

        Flash::success('Course deleted successfully.');

        return redirect(route('courses.index'));
    }

    
}
