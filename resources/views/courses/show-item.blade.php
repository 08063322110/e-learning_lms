<div class="container-fluid" style="padding: 20px;"> {{-- container-fluid gives more width --}}
    <div class="row">

        {{-- LEFT: Video 8 cols --}}
        <div class="col-md-8">
            <h2>{{ $item->title }}</h2>       

            <div class="embed-responsive embed-responsive-16by9" style="margin-bottom:20px;">
                <iframe class="embed-responsive-item" 
                src="https://www.youtube.com/embed/2zyNun4Meuw" 
                allowfullscreen></iframe>
            </div>    
        </div>

        {{-- RIGHT: Curriculum 4 cols --}}
        <div class="col-md-4">
                            <h3 style="padding: 15px; margin: 0; border-bottom: 1px solid #ddd; font-size: 20px; font-weight: 700;">Curriculum</h3>

            <div style="border: 1px solid #ddd; border-radius: 4px; background: #fff;">
                
                <div class="list-group" style="margin-bottom: 0; max-height: 500px; overflow-y: auto;">
                    @foreach ($course->items as $newItem)
                    <a href="{{ route('courses.items', ['course_id' => $course->id, 'item_id' => $newItem->id] ) }}" 
                        class="list-group-item @if ($item->id == $newItem->id) active @endif" 
                        style="border-left: 0; border-right: 0; border-radius: 0; font-size: 15px; padding: 12px 15px;">
                        
<i class="fa-solid fa-play" style="margin-right: 8px; font-size: 12px;"></i>                        {{ $newItem->title }} 
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>