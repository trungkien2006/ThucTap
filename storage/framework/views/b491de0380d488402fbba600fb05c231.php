<?php $__env->startSection('content'); ?>
<div class="max-w-[1000px] mx-auto">
    <!-- Page Header -->
    <div class="flex items-center gap-3 mb-8">
        <a href="<?php echo e(route('admin.events.show', $event)); ?>" class="w-9 h-9 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-50 hover:text-primary transition-all">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>
        <div>
            <h1 class="text-[24px] font-bold text-primary font-heading leading-tight">Chỉnh sửa sự kiện</h1>
            <p class="text-[13px] text-slate-400 mt-0.5"><?php echo e($event->title); ?></p>
        </div>
    </div>

    <form action="<?php echo e(route('admin.events.update', $event)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <input type="hidden" name="has_speakers_field" value="1">


        <!-- Section 1: Basic Info -->
        <section class="uni-card p-6 space-y-5">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">info</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Thông tin cơ bản</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="uni-label" for="title">Tiêu đề sự kiện <span class="text-red-400">*</span></label>
                    <input class="uni-input" id="title" name="title" value="<?php echo e(old('title', $event->title)); ?>" required type="text"/>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div>
                    <label class="uni-label" for="slug">Đường dẫn (URL Slug) <span class="text-red-400">*</span></label>
                    <input class="uni-input" id="slug" name="slug" value="<?php echo e(old('slug', $event->slug)); ?>" required type="text"/>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <div>
                <label class="uni-label" for="description">Mô tả chi tiết <span class="text-red-400">*</span></label>
                <textarea class="uni-input" id="description" name="description" rows="4" required><?php echo e(old('description', $event->description)); ?></textarea>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </section>

        <!-- Section 2: Time & Location -->
        <section class="uni-card p-6 space-y-5">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">schedule</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Thời gian & Địa điểm</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="uni-label" for="event_date">Ngày & Giờ bắt đầu <span class="text-red-400">*</span></label>
                    <input class="uni-input" id="event_date" name="event_date" value="<?php echo e(old('event_date', $event->event_date->format('Y-m-d\TH:i'))); ?>" required type="datetime-local"/>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['event_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div>
                    <label class="uni-label" for="end_date">Ngày & Giờ kết thúc (tùy chọn)</label>
                    <input class="uni-input" id="end_date" name="end_date" value="<?php echo e(old('end_date', $event->end_date ? $event->end_date->format('Y-m-d\TH:i') : '')); ?>" type="datetime-local"/>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <div class="mt-5">
                <label class="uni-label" for="location">Địa điểm <span class="text-red-400">*</span></label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400 text-[18px]">location_on</span>
                    <input class="uni-input pl-10" id="location" name="location" value="<?php echo e(old('location', $event->location)); ?>" required type="text"/>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </section>

        <!-- Section 3: Classification -->
        <section class="uni-card p-6 space-y-5">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">category</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Phân loại & Giới hạn</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="uni-label" for="category_id">Loại sự kiện</label>
                    <select class="uni-input" id="category_id" name="category_id">
                        <option value="">— Chọn —</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id', $event->category_id) == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="uni-label" for="department_ids">Chuyên ngành (Có thể chọn nhiều)</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 mt-2">
                        <input type="hidden" name="has_departments_field" value="1">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <label class="relative block cursor-pointer group">
                                <?php
                                    $isChecked = false;
                                    if (old('_token') !== null) {
                                        $isChecked = is_array(old('department_ids')) && in_array($dept->id, old('department_ids'));
                                    } else {
                                        $isChecked = $event->departments->contains($dept->id);
                                    }
                                ?>
                                <input type="checkbox" name="department_ids[]" value="<?php echo e($dept->id); ?>" <?php echo e($isChecked ? 'checked' : ''); ?> class="peer sr-only">
                                <div class="flex items-center justify-center px-3 py-2.5 border border-slate-200 rounded-xl bg-white text-[13px] font-semibold text-slate-600 transition-all duration-200 peer-checked:border-brand-orange peer-checked:bg-orange-50 peer-checked:text-brand-orange group-hover:border-brand-orange/50 shadow-sm text-center h-full">
                                    <?php echo e($dept->name); ?>

                                </div>
                                <div class="absolute -top-1.5 -right-1.5 w-5 h-5 bg-brand-orange text-white rounded-full flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-all duration-200 transform scale-50 peer-checked:scale-100 shadow-md">
                                    <span class="material-symbols-outlined text-[12px] font-bold">check</span>
                                </div>
                            </label>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 4: Speakers -->
        <section class="uni-card p-6 space-y-5">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">groups</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Diễn giả</h3>
            </div>
            <div>
                <div class="flex items-center justify-between gap-3 mb-2 flex-wrap">
                    <label class="uni-label mb-0">Chọn diễn giả (Có thể chọn nhiều)</label>
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <button type="button" class="open-add-speaker-modal-btn btn-ghost py-1.5 px-3 text-xs flex items-center gap-1 border border-slate-200">
                            <span class="material-symbols-outlined text-[16px]">add</span>
                            Thêm mới
                        </button>
                        <div class="relative flex-1 sm:w-64">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400 text-[18px]">search</span>
                            <input type="text" id="speaker_search" placeholder="Tìm kiếm diễn giả..." class="uni-input py-1.5 text-xs" style="padding-left: 2.5rem !important;">
                        </div>
                    </div>
                </div>
                <div id="speaker_list_container" class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-[240px] overflow-y-auto p-2 border border-slate-200 rounded-xl bg-slate-50/50">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $speakers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $photoUrl = $speaker->photo_url 
                                ? ((strpos($speaker->photo_url, 'http') === 0 || strpos($speaker->photo_url, '/') === 0) ? $speaker->photo_url : \App\Helpers\FileHelper::url($speaker->photo_url)) 
                                : 'https://ui-avatars.com/api/?name='.urlencode($speaker->name).'&background=random';
                        ?>
                        <label class="flex items-center justify-between p-3 bg-white border border-slate-200 rounded-lg cursor-pointer hover:border-brand-orange transition-all relative">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="speaker_ids[]" value="<?php echo e($speaker->id); ?>" <?php echo e((is_array(old('speaker_ids')) && in_array($speaker->id, old('speaker_ids'))) || (!old('speaker_ids') && $event->speakers->contains($speaker->id)) ? 'checked' : ''); ?> class="rounded border-slate-300 text-brand-orange focus:ring-brand-orange w-4 h-4">
                                <div class="flex items-center gap-3">
                                    <img src="<?php echo e($photoUrl); ?>" class="w-8 h-8 rounded-full object-cover">
                                    <div>
                                        <p class="text-[13px] font-semibold text-primary speaker-name-text"><?php echo e($speaker->name); ?></p>
                                        <p class="text-[11px] text-slate-400 speaker-title-text"><?php echo e($speaker->title ?? 'Diễn giả'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="speaker-details-btn p-1 text-slate-400 hover:text-brand-orange hover:bg-slate-50 rounded-lg transition-colors z-20"
                                data-name="<?php echo e($speaker->name); ?>"
                                data-title="<?php echo e($speaker->title ?? ''); ?>"
                                data-photo="<?php echo e($photoUrl); ?>"
                                data-bio="<?php echo e($speaker->bio ?? ''); ?>"
                                data-type="<?php echo e($speaker->type ?? 'speaker'); ?>">
                                <span class="material-symbols-outlined text-[20px]">info</span>
                            </button>
                        </label>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <div class="col-span-full py-6 text-center">
                            <p class="text-[13px] text-slate-400">Chưa có diễn giả nào trong hệ thống.</p>
                            <button type="button" class="open-add-speaker-modal-btn inline-flex items-center gap-1.5 text-brand-orange text-[12px] font-semibold hover:underline mt-2">
                                <span class="material-symbols-outlined text-[16px]">add_circle</span>
                                Thêm diễn giả mới
                            </button>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                    <!-- Search Empty State -->
                    <div id="speaker_search_empty" class="hidden col-span-full py-6 text-center">
                        <p class="text-[13px] text-slate-400">Không tìm thấy diễn giả nào khớp với từ khóa.</p>
                        <button type="button" class="open-add-speaker-modal-btn inline-flex items-center gap-1.5 text-brand-orange text-[12px] font-semibold hover:underline mt-2">
                            <span class="material-symbols-outlined text-[16px]">add_circle</span>
                            Thêm diễn giả mới
                        </button>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['speaker_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </section>



        <!-- Section 6: Banner -->
        <section class="uni-card p-6 space-y-5">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">image</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Ảnh bìa sự kiện</h3>
            </div>
            
            <?php
                $hasBanner = $event->bannerImage && $event->bannerImage->url;
                $bannerUrl = $hasBanner ? \App\Helpers\FileHelper::url($event->bannerImage->url) : '';
            ?>
            
            <div id="preview_container" class="<?php echo e($hasBanner ? '' : 'hidden'); ?> rounded-xl overflow-hidden border border-slate-200 h-[320px] mb-4">
                <img id="banner_preview" src="<?php echo e($bannerUrl); ?>" alt="Preview" class="w-full h-full object-cover">
            </div>

            <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 flex flex-col items-center justify-center gap-2 bg-slate-50/30 hover:bg-slate-50 hover:border-brand-orange transition-all cursor-pointer relative">
                <input type="file" id="banner_image" name="banner_image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"/>
                <span class="material-symbols-outlined text-[24px] text-brand-orange">cloud_upload</span>
                <p class="text-[12px] font-medium text-primary" id="banner_filename">Chọn ảnh mới (tùy chọn)</p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['banner_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-[11px] mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </section>


        <!-- Section 7: Status & Options -->
        <section class="uni-card p-6 space-y-4">
            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                <span class="material-symbols-outlined text-primary text-[20px]">tune</span>
                <h3 class="text-[16px] font-bold text-primary font-heading">Trạng thái & Tùy chọn</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-1 gap-5">
                <div>
                    <label class="uni-label" for="status">Trạng thái <span class="text-red-400">*</span></label>
                    <select class="uni-input" id="status" name="status" required>
                        <?php
                            $currentStatus = $event->status ?: 'draft';
                            // Fallback for old data if status is just 'draft' but actually published
                            if ($currentStatus === 'draft' && $event->is_published) {
                                $currentStatus = ($event->event_date && $event->event_date < now()) ? 'ended' : 'published';
                            }
                        ?>
                        <option value="draft" <?php echo e($currentStatus == 'draft' ? 'selected' : ''); ?>>Bản nháp</option>
                        <option value="published" <?php echo e($currentStatus == 'published' ? 'selected' : ''); ?>>Đã xuất bản</option>
                    </select>
                </div>
            </div>
        </section>

        <!-- Actions -->
        <div class="flex items-center justify-between pt-4">
            <a href="<?php echo e(route('admin.events.show', $event)); ?>" class="btn-ghost">Hủy bỏ</a>
            <div class="flex gap-3">
                <button type="submit" name="redirect_to" value="design" class="btn-ghost border border-slate-200 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]">palette</span>
                    Lưu & Chọn Mẫu
                </button>
                <button type="submit" name="redirect_to" value="index" class="btn-primary flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                    Cập nhật sự kiện
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Speaker Details Modal -->
<div id="speakerModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl p-6 relative transform transition-all scale-95 duration-200 border border-slate-100">
        <!-- Close Button -->
        <button type="button" id="closeSpeakerModalBtn" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-1 hover:bg-slate-100 rounded-lg transition-all flex items-center justify-center">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
        
        <!-- Modal Content -->
        <div class="flex flex-col items-center text-center mt-2">
            <img id="modalSpeakerPhoto" src="" alt="" class="w-24 h-24 rounded-full object-cover shadow-md border-2 border-slate-100">
            <h3 id="modalSpeakerName" class="text-[18px] font-bold text-primary font-heading mt-4"></h3>
            <p id="modalSpeakerTitle" class="text-[13px] text-brand-orange font-semibold mt-1"></p>
            <span id="modalSpeakerType" class="mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800"></span>
            
            <div class="w-full border-t border-slate-100 my-4"></div>
            
            <div class="w-full text-left">
                <h4 class="text-[11px] uppercase tracking-wider text-slate-400 font-bold mb-1.5">Giới thiệu</h4>
                <p id="modalSpeakerBio" class="text-[13px] text-slate-600 leading-relaxed max-h-36 overflow-y-auto whitespace-pre-wrap bg-slate-50 p-3 rounded-lg border border-slate-100"></p>
            </div>
        </div>
    </div>
</div>

<!-- Add Speaker Modal -->
<div id="addSpeakerModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl p-6 relative transform transition-all scale-95 duration-200 border border-slate-100">
        <!-- Close Button -->
        <button type="button" id="closeAddSpeakerModalBtn" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-1 hover:bg-slate-100 rounded-lg transition-all flex items-center justify-center">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
        
        <h3 class="text-[18px] font-bold text-primary font-heading mb-4">Thêm diễn giả mới</h3>
        
        <form id="ajaxAddSpeakerForm" class="space-y-4">
            <div>
                <label class="uni-label" for="new_speaker_name">Họ & Tên <span class="text-red-400">*</span></label>
                <input type="text" id="new_speaker_name" name="name" required class="uni-input py-2 text-xs" placeholder="VD: Nguyễn Văn A">
            </div>
            <div>
                <label class="uni-label" for="new_speaker_title">Chức danh / Chuyên môn</label>
                <input type="text" id="new_speaker_title" name="title" class="uni-input py-2 text-xs" placeholder="VD: Chuyên gia Trí tuệ nhân tạo">
            </div>
            <div>

                <label class="uni-label" for="new_speaker_photo">Ảnh đại diện</label>
                <input type="file" id="new_speaker_photo" name="photo" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-50 file:text-brand-orange hover:file:bg-slate-100">
            </div>
            <div>
                <label class="uni-label" for="new_speaker_bio">Tiểu sử / Giới thiệu ngắn</label>
                <textarea id="new_speaker_bio" name="bio" rows="3" class="uni-input py-2 text-xs" placeholder="Giới thiệu kinh nghiệm, lĩnh vực hoạt động..."></textarea>
            </div>
            
            <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                <button type="button" id="cancelAddSpeakerBtn" class="btn-ghost py-2 text-xs">Hủy</button>
                <button type="submit" class="btn-primary py-2 text-xs flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px] hidden animate-spin" id="add_speaker_spinner">sync</span>
                    Lưu diễn giả
                </button>
            </div>
        </form>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
            .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
            .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
            .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
            .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
            .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
            .replace(/đ/gi, 'd')
            .replace(/\s+/g, '-')
            .replace(/[^a-z0-9-]/g, '')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
        
        // Only auto-fill if the user hasn't manually edited the slug
        const slugInput = document.getElementById('slug');
        if (!slugInput.dataset.manuallyEdited) {
            slugInput.value = slug;
        }
    });

    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.manuallyEdited = true;
    });

    // Speaker Modal logic
    const speakerModal = document.getElementById('speakerModal');
    const closeBtn = document.getElementById('closeSpeakerModalBtn');
    
    document.querySelectorAll('.speaker-details-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const name = this.getAttribute('data-name');
            const title = this.getAttribute('data-title');
            const photo = this.getAttribute('data-photo');
            const bio = this.getAttribute('data-bio');
            const type = this.getAttribute('data-type');
            
            document.getElementById('modalSpeakerPhoto').src = photo;
            document.getElementById('modalSpeakerPhoto').alt = name;
            document.getElementById('modalSpeakerName').textContent = name;
            document.getElementById('modalSpeakerTitle').textContent = title || 'Diễn giả';
            document.getElementById('modalSpeakerBio').textContent = bio || 'Chưa có thông tin giới thiệu.';
            
            const typeBadge = document.getElementById('modalSpeakerType');
            if (typeBadge) {
                typeBadge.textContent = 'Diễn giả';
                typeBadge.className = 'mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-100';
            }
            
            speakerModal.classList.remove('hidden');
        });
    });
    
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            speakerModal.classList.add('hidden');
        });
    }
    
    window.addEventListener('click', function(e) {
        if (e.target === speakerModal) {
            speakerModal.classList.add('hidden');
        }
    });

    // Image Preview logic
    const bannerImageInput = document.getElementById('banner_image');
    const previewContainer = document.getElementById('preview_container');
    const bannerPreview = document.getElementById('banner_preview');
    const bannerFilename = document.getElementById('banner_filename');

    if (bannerImageInput) {
        bannerImageInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                if (bannerFilename) {
                    bannerFilename.textContent = file.name;
                }
                const reader = new FileReader();
                reader.onload = function(event) {
                    bannerPreview.src = event.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Speaker Search Filter logic
    const speakerSearch = document.getElementById('speaker_search');
    const speakerListContainer = document.getElementById('speaker_list_container');
    const speakerItems = speakerListContainer ? speakerListContainer.querySelectorAll('label') : [];
    const speakerEmptyState = document.getElementById('speaker_search_empty');

    if (speakerSearch) {
        speakerSearch.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            let hasVisibleItem = false;
            const items = speakerListContainer ? speakerListContainer.querySelectorAll('label') : [];

            items.forEach(item => {
                const nameNode = item.querySelector('.speaker-name-text');
                const titleNode = item.querySelector('.speaker-title-text');
                const name = nameNode ? nameNode.textContent.toLowerCase() : '';
                const title = titleNode ? titleNode.textContent.toLowerCase() : '';
                
                if (name.includes(query) || title.includes(query)) {
                    item.classList.remove('hidden');
                    hasVisibleItem = true;
                } else {
                    item.classList.add('hidden');
                }
            });

            if (hasVisibleItem) {
                if (speakerEmptyState) speakerEmptyState.classList.add('hidden');
            } else {
                if (speakerEmptyState) speakerEmptyState.classList.remove('hidden');
            }
        });
    }

    // Add Speaker Modal controls
    const addSpeakerModal = document.getElementById('addSpeakerModal');
    const openAddSpeakerBtns = document.querySelectorAll('.open-add-speaker-modal-btn');
    const closeAddSpeakerModalBtn = document.getElementById('closeAddSpeakerModalBtn');
    const cancelAddSpeakerBtn = document.getElementById('cancelAddSpeakerBtn');
    const ajaxAddSpeakerForm = document.getElementById('ajaxAddSpeakerForm');
    const addSpeakerSpinner = document.getElementById('add_speaker_spinner');

    if (openAddSpeakerBtns) {
        openAddSpeakerBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                addSpeakerModal.classList.remove('hidden');
            });
        });
    }

    const closeAddModal = () => {
        addSpeakerModal.classList.add('hidden');
        ajaxAddSpeakerForm.reset();
    };

    if (closeAddSpeakerModalBtn) closeAddSpeakerModalBtn.addEventListener('click', closeAddModal);
    if (cancelAddSpeakerBtn) cancelAddSpeakerBtn.addEventListener('click', closeAddModal);

    window.addEventListener('click', function(e) {
        if (e.target === addSpeakerModal) {
            closeAddModal();
        }
    });

    if (ajaxAddSpeakerForm) {
        ajaxAddSpeakerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (addSpeakerSpinner) addSpeakerSpinner.classList.remove('hidden');
            const submitBtn = ajaxAddSpeakerForm.querySelector('button[type="submit"]');
            if (submitBtn) submitBtn.disabled = true;

            const formData = new FormData(this);

            fetch('<?php echo e(route("admin.speakers.store")); ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.success && data.speaker) {
                    const sp = data.speaker;
                    
                    const photoUrl = sp.photo_url 
                        ? ((sp.photo_url.indexOf('http') === 0 || sp.photo_url.indexOf('/') === 0) ? sp.photo_url : `/storage/${sp.photo_url}`)
                        : `https://ui-avatars.com/api/?name=${encodeURIComponent(sp.name)}&background=random`;

                    const newHtml = `
                        <label class="flex items-center justify-between p-3 bg-white border border-slate-200 rounded-lg cursor-pointer hover:border-brand-orange transition-all relative">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="speaker_ids[]" value="${sp.id}" checked class="rounded border-slate-300 text-brand-orange focus:ring-brand-orange w-4 h-4">
                                <div class="flex items-center gap-3">
                                    <img src="${photoUrl}" class="w-8 h-8 rounded-full object-cover">
                                    <div>
                                        <p class="text-[13px] font-semibold text-primary speaker-name-text">${sp.name}</p>
                                        <p class="text-[11px] text-slate-400 speaker-title-text">${sp.title || 'Diễn giả'}</p>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="speaker-details-btn p-1 text-slate-400 hover:text-brand-orange hover:bg-slate-50 rounded-lg transition-colors z-20"
                                data-name="${sp.name}"
                                data-title="${sp.title || ''}"
                                data-photo="${photoUrl}"
                                data-bio="${sp.bio || ''}"
                                data-type="${sp.type || 'speaker'}">
                                <span class="material-symbols-outlined text-[20px]">info</span>
                            </button>
                        </label>
                    `;

                    const emptyState = document.getElementById('speaker_search_empty');
                    if (emptyState) {
                        emptyState.insertAdjacentHTML('beforebegin', newHtml);
                    } else {
                        speakerListContainer.insertAdjacentHTML('beforeend', newHtml);
                    }

                    // Re-bind details click listener
                    const newLabel = (emptyState ? emptyState.previousElementSibling : speakerListContainer.lastElementChild);
                    const newBtn = newLabel.querySelector('.speaker-details-btn');
                    if (newBtn) {
                        newBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            
                            const name = this.getAttribute('data-name');
                            const title = this.getAttribute('data-title');
                            const photo = this.getAttribute('data-photo');
                            const bio = this.getAttribute('data-bio');
                            const type = this.getAttribute('data-type');
                            
                            document.getElementById('modalSpeakerPhoto').src = photo;
                            document.getElementById('modalSpeakerPhoto').alt = name;
                            document.getElementById('modalSpeakerName').textContent = name;
                            document.getElementById('modalSpeakerTitle').textContent = title || 'Diễn giả';
                            document.getElementById('modalSpeakerBio').textContent = bio || 'Chưa có thông tin giới thiệu.';
                            
                            const typeBadge = document.getElementById('modalSpeakerType');
                            if (typeBadge) {
                                typeBadge.textContent = 'Diễn giả';
                                typeBadge.className = 'mt-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-100';
                            }
                            
                            document.getElementById('speakerModal').classList.remove('hidden');
                        });
                    }

                    if (speakerSearch) {
                        speakerSearch.value = '';
                        speakerSearch.dispatchEvent(new Event('input'));
                    }

                    closeAddModal();
                } else {
                    alert('Không thể lưu diễn giả. Vui lòng thử lại.');
                }
            })
            .catch(err => {
                console.error(err);
                if (err.errors) {
                    const firstErr = Object.values(err.errors)[0][0];
                    alert('Lỗi: ' + firstErr);
                } else {
                    alert('Có lỗi xảy ra khi thêm diễn giả.');
                }
            })
            .finally(() => {
                if (addSpeakerSpinner) addSpeakerSpinner.classList.add('hidden');
                if (submitBtn) submitBtn.disabled = false;
            });
        });
    }


</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['hideTopMenu' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\admin\Downloads\ThucTap-main\ThucTap-main\resources\views/admin/events/edit.blade.php ENDPATH**/ ?>