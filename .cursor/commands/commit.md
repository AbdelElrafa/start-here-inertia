---
description: Analyze all changes, categorize them, and create atomic commits
argument-hint: [optional message hint or focus area]
---

Analyze all working directory changes and guide the user through a smart commit workflow.

## Gather Context

!`git status`

!`git branch -v`

!`git diff`

!`git diff --staged`

!`git log --oneline -5`

## Your Task

### 1. Understand the Branch Context

- What is the current branch name? Infer its purpose (feature, bugfix, refactor, etc.)
- Review recent commits to understand what work belongs here
- If on `main`/`master`, be extra careful about what gets committed directly

### 2. Categorize All Changes

Review every modified, added, and deleted file. Categorize each into ONE of these groups:

**A. Belongs to this branch** - Changes that fit the branch's purpose
- Should be committed (may need grouping into multiple atomic commits)

**B. Belongs to a different branch** - Changes unrelated to current branch purpose
- Suggest creating/switching to appropriate branch
- Examples: started a new feature while on a bugfix branch

**C. Local development artifacts** - Should be IGNORED (add to .gitignore or leave unstaged)
- IDE settings, local config overrides, personal scripts
- `.env.local`, `.vscode/settings.json`, `*.local.*` files
- Temporary debug files, scratch files

**D. Testing artifacts** - Should be UNDONE (git restore)
- Console.logs added for debugging
- Commented-out code from testing
- Hardcoded test values that shouldn't be committed
- Temporary hacks to test something

### 3. Present Your Analysis

Show the user a clear breakdown:

```
📋 CHANGE ANALYSIS FOR BRANCH: [branch-name]

✅ COMMIT (belongs to this branch):
   • file1.ts - [brief description of change]
   • file2.ts - [brief description of change]

🔀 DIFFERENT BRANCH (doesn't belong here):
   • file3.ts - [why it doesn't belong, suggested branch]

🚫 IGNORE (local dev artifacts):
   • .env.local - local environment config

⏪ UNDO (testing artifacts):
   • utils.ts:42 - console.log added for debugging
```

### 4. Get User Confirmation

Before taking any action, ask the user to confirm:
- Do they agree with the categorization?
- Should any files be re-categorized?
- Are they ready to proceed?

### 5. Execute the Workflow

Based on user confirmation:

**For files to UNDO**: Offer to run `git restore <file>` or `git checkout -- <file>`

**For files to IGNORE**: Suggest adding to `.gitignore` if appropriate

**For files needing DIFFERENT BRANCH**:
- Offer to stash them: `git stash push -m "description" -- <files>`
- Or suggest creating a new branch for them later

**For files to COMMIT**:
- If multiple logical groups exist, guide through separate atomic commits
- For each commit group:
  1. Stage the relevant files: `git add <files>`
  2. Generate 3-5 commit message options using format: `<action> <what> [<context>]`
  3. Let user pick or customize
  4. Execute: `git commit -m "SELECTED_MESSAGE"`
  5. Repeat for next group

### 6. Branch Suggestions

If the changes don't make sense for the current branch at all:
- Suggest the user might want to switch branches first
- Offer to stash all changes: `git stash push -m "WIP: description"`
- Recommend which branch to work on

## Commit Message Format

**Structure:** `<action> <what> [<detail or reason>].`

**Requirements:**
- Complete sentence with proper punctuation (end with a period)
- One logical change per commit (atomic)
- Clear and easy to understand at a glance
- Single sentence, occasionally two if truly needed

**Action verbs:**
- `Add` - New feature, file, or functionality
- `Update` - Changes to existing functionality or configuration
- `Fix` - Bug fixes
- `Remove` - Deletion of code or files
- `Refactor` - Code restructuring without behavior change
- `Rename` - Renaming files or functions
- `Move` - Relocating files or code
- `Restore` - Bringing back previously deleted code

**Good examples:**
- `Add user authentication endpoint.`
- `Fix null pointer in checkout flow.`
- `Update dashboard to show recent activity.`
- `Remove deprecated payment provider.`
- `Add the base app url to the config and replace the hardcoded url.`
- `Update phpmailer smtp class to support all TLS versions.`

**Bad examples:**
- `Add user authentication endpoint with JWT tokens and refresh token support for the new login system` ❌ (too verbose, missing period)
- `Fix things` ❌ (too vague)
- `Update stuff` ❌ (not specific)

## User Hint

If provided, incorporate this context: $ARGUMENTS