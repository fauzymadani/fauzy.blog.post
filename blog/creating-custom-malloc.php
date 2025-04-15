<?php include __DIR__ . '/../include/layout/header.php'; ?>
<?php include __DIR__ . '/../include/layout/sidebar.php'; ?>

<main>
    <section id="blog" class="active">
        <header><i><a href="permalink.php">Tue 01 Apr 2024 14:11:05 AM</a></i></header>
        <h2>Creating Custom <code>malloc</code> in C</h2>

        <p>
            In C, memory management is traditionally handled using functions like <code>malloc</code>, <code>calloc</code>, <code>realloc</code>, and <code>free</code>. However, in some cases—especially for embedded systems, custom allocators, debugging tools, or performance-critical applications—you may want to implement your own memory allocator.
        </p>

        <p>
            This post dives into the fundamentals of building a custom <code>malloc</code> from scratch in C. We'll discuss how memory allocation works under the hood, implement a simple memory pool allocator, and even override the standard <code>malloc</code> for educational or debugging purposes.
        </p>

        <h3>1. Setting Up a Memory Pool</h3>
        <p>
            Instead of requesting memory from the OS every time, we pre-allocate a large chunk of memory and manage it ourselves. This method is especially useful in systems with limited resources or strict real-time constraints.
        </p>

        <pre>
#define POOL_SIZE 1024 * 1024  // 1 MB
static char memory_pool[POOL_SIZE];
static size_t memory_offset = 0;

void* my_malloc(size_t size) {
    if (memory_offset + size > POOL_SIZE) {
        return NULL; // Out of memory
    }
    void* ptr = &memory_pool[memory_offset];
    memory_offset += size;
    return ptr;
}
    </pre>

        <h3>2. Adding Free List for Reusability</h3>
        <p>
            The naive allocator above doesn't support freeing memory. Let's enhance it by implementing a free list. Each block will have a small header indicating its size and whether it’s free.
        </p>

        <pre>
typedef struct block_header {
    size_t size;
    int is_free;
    struct block_header* next;
} block_header;

#define ALIGNMENT 8
#define BLOCK_HEADER_SIZE sizeof(block_header)

static char memory_pool[POOL_SIZE];
static block_header* free_list = (void*)memory_pool;

void initialize() {
    free_list->size = POOL_SIZE - BLOCK_HEADER_SIZE;
    free_list->is_free = 1;
    free_list->next = NULL;
}
    </pre>

        <h3>3. Allocation Logic</h3>
        <p>
            Here's a simple first-fit allocation algorithm that walks the free list looking for a block large enough to satisfy the request.
        </p>

        <pre>
void* my_malloc(size_t size) {
    block_header* curr = free_list;

    while (curr != NULL) {
        if (curr->is_free && curr->size >= size) {
            curr->is_free = 0;
            return (void*)(curr + 1);
        }
        curr = curr->next;
    }

    return NULL; // Out of memory
}
    </pre>

        <h3>4. Implementing <code>my_free</code></h3>
        <p>
            Once a block is freed, we mark it and optionally coalesce adjacent free blocks to prevent fragmentation.
        </p>

        <pre>
void my_free(void* ptr) {
    if (!ptr) return;

    block_header* block = (block_header*)ptr - 1;
    block->is_free = 1;

    // Optional: Implement coalescing here
}
    </pre>

        <h3>5. Overriding Standard <code>malloc</code></h3>
        <p>
            For testing or debugging, you can override the standard malloc/free using linker tricks or macros.
        </p>

        <pre>
#define malloc(size) my_malloc(size)
#define free(ptr) my_free(ptr)
    </pre>

        <p>
            Be cautious when overriding globally, as some system calls or libraries expect behavior specific to the standard allocator.
        </p>

        <h3>6. Debugging Tools and Enhancements</h3>
        <ul>
            <li>Add canary values before and after allocations to detect buffer overflows.</li>
            <li>Log every allocation and free with file and line number using macros.</li>
            <li>Track memory leaks by recording allocations in a hash map.</li>
        </ul>

        <pre>
#define malloc(size) debug_malloc(size, __FILE__, __LINE__)
#define free(ptr) debug_free(ptr, __FILE__, __LINE__)

void* debug_malloc(size_t size, const char* file, int line) {
    void* ptr = my_malloc(size);
    printf("Allocated %zu bytes at %p [%s:%d]\n", size, ptr, file, line);
    return ptr;
}
    </pre>

        <h3>Conclusion</h3>
        <p>
            Building a custom <code>malloc</code> helps you understand how dynamic memory works at a low level, and can be tailored to suit your specific needs—whether for performance, debugging, or system constraints.
        </p>

        <p>
            Keep in mind that this is just a starting point. Production-level allocators deal with fragmentation, concurrency, alignment, caching, and much more. For more advanced use cases, study memory allocators like jemalloc, tcmalloc, or the Linux slab allocator.
        </p>

    </section>
    <div class="inner-footer">
        <div>
            All content licensed under <a href="https://www.gnu.org/licenses/gpl-3.0.en.html">GPL 3.0 License</a> 2024 - Fauzy
        </div>
        <div>
            This site is powered by <a href="https://www.vim.org/">Vim</a>, and <a href="https://www.php.net/">php</a>
        </div>
    </div>

</main>

<?php include __DIR__ . '/../include/layout/footer.php'; ?>
