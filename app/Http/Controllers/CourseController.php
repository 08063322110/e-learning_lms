<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Repositories\CourseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Auth;
use Response;
use App\Models\Category;
use App\Models\Course;

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
        $courses = $this->courseRepository->all();

        return view('courses.index')
            ->with('courses', $courses);
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
        $course = $this->courseRepository->find($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        return view('courses.show')->with('course', $course);
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

        return view('courses.edit')->with('course', $course);
    }

    /**
     * Update the specified Course in storage.
     *
     * @param int $id
     * @param UpdateCourseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCourseRequest $request)
    {
        $course = $this->courseRepository->find($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        $course = $this->courseRepository->update($request->all(), $id);

        Flash::success('Course updated successfully.');

        return redirect(route('courses.index'));
    }

    /**
     * Remove the specified Course from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
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
