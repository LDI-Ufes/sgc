<?php

namespace App\Http\Controllers;

use App\Helpers\ModelFilterHelper;
use App\Helpers\SgcLogHelper;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\CourseType;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    public function __construct(CourseService $courseService)
    {
        $this->service = $courseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //check access permission
        if (! Gate::allows('course-list')) {
            SgcLogHelper::logBadAttemptOnUri($request, 403);
            abort(403);
        }

        //filters
        $filters = ModelFilterHelper::buildFilters($request, Course::$accepted_filters);

        $courses = $this->service->list();

        return view('course.index', compact('courses', 'filters'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //check access permission
        if (! Gate::allows('course-store')) {
            SgcLogHelper::logBadAttemptOnUri($request, 403);
            abort(403);
        }

        $courseTypes = CourseType::orderBy('name')->get();

        return view('course.create', compact('courseTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCourseRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        //check access permission
        if (! Gate::allows('course-store')) {
            SgcLogHelper::logBadAttemptOnUri($request, 403);
            abort(403);
        }

        $this->service->create($request->validated());

        return redirect()->route('courses.index')->with('success', 'Curso criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Request $request)
    {
        //check access permission
        if (! Gate::allows('course-show')) {
            SgcLogHelper::logBadAttemptOnUri($request, 403);
            abort(403);
        }

        $this->service->read($course);

        return view('course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, Request $request)
    {
        //check access permission
        if (! Gate::allows('course-update')) {
            SgcLogHelper::logBadAttemptOnUri($request, 403);
            abort(403);
        }

        $courseTypes = CourseType::orderBy('name')->get();

        return view('course.edit', compact('course', 'courseTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCourseRequest $request
     * @param Course $course
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //check access permission
        if (! Gate::allows('course-update')) {
            SgcLogHelper::logBadAttemptOnUri($request, 403);
            abort(403);
        }

        try {
            $this->service->update($request->validated(), $course);
        } catch (\Exception $e) {
            return back()->withErrors(['noStore' => 'N??o foi poss??vel salvar o curso: ' . $e->getMessage()]);
        }

        return redirect()->route('courses.index')->with('success', 'Curso atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, Request $request)
    {
        //check access permission
        if (! Gate::allows('course-destroy')) {
            SgcLogHelper::logBadAttemptOnUri($request, 403);
            abort(403);
        }

        try {
            $this->service->delete($course);
        } catch (\Exception $e) {
            return back()->withErrors(['noDestroy' => 'N??o foi poss??vel excluir o curso: ' . $e->getMessage()]);
        }

        return redirect()->route('courses.index')->with('success', 'Curso exclu??do com sucesso.');
    }
}
